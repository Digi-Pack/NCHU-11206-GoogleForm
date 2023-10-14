<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Coworker;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Services\FileService;
use PhpParser\Node\Expr\Cast\Object_;

class ReplyController extends Controller
{
    public function __construct(protected FileService $fileService)
    {
    }
    public function reply_index(Request $request, $id)
    {
        // ********第一種狀況：從預覽連接到填寫問卷頁--------------------------------------------
        // 如果是用複製網址的方式($id是亂碼)，就(應該機率很小)抓不到id是這個亂碼的問卷
        $responseForm = Question::where('id', $id)->get();
        // ***第一種情況之一：當沒有抓到問卷時，且自己是 主編者 或 共同編輯者 時，先存問卷再提供填寫頁面

        // ***第一種情況之二：當有抓到問卷，且自己是 主編者 或 共同編輯者 時，可以透過 預覽 ，訪問填寫問卷頁
        if (!$responseForm->isEmpty()) {
            // 當自己是主編者時
            if ($request->user()->id == $responseForm[0]['lead_author_id']) {
                $questionNaires = json_decode($responseForm[0]['questionnaires'], true);
                $response = [
                    'responseForm' => $responseForm,
                    'questionNaires' => $questionNaires,
                ];
                return Inertia::render('Frontend/ReplyIndex', ['response' => rtFormat($response)]);
            }
            // 查找這份問卷的共同編輯者
            $coworkers = Coworker::where('question_id', $id)->get();
            // 將共同編輯者的id成一個陣列$coworkerArray
            $coworkerArray = [];
            foreach ($coworkers as $item) {
                $who = $item['coworker_id'];
                $coworkerArray[] = $who;
            }
            // 如果使用者是共同編輯者，也可以預覽問卷
            if (in_array($request->user()->id, $coworkerArray)) {
                $questionNaires = json_decode($responseForm[0]['questionnaires'], true);
                $response = [
                    'responseForm' => $responseForm,
                    'questionNaires' => $questionNaires,
                ];
                return Inertia::render('Frontend/ReplyIndex', ['response' => rtFormat($response)]);
            }
        }

        // ********第二種狀況：查詢資料庫中是否有該亂數(網址)的問卷-------------------------------
        $responseForm = Question::where('random', $id)->get();
        // 如果有該問卷
        if (!$responseForm->isEmpty()) {
            // 查詢回覆資料庫中，是否有該使用者填寫過的該份問卷
            $hasBeen = Response::where('user_id', $request->user()->id)->where('question_id', $responseForm[0]['id'])->get();
            // 如果有，則前往修改答案的頁面
            if (!$hasBeen->isEmpty()) {

                $redirectValue = [
                    'user_id' => $request->user()->id,
                    'question_id' => $responseForm[0]['id'],
                ];
                // 將使用者的資料帶到下一支function，為避免帶錯資料，先FORGET再PUT
                session()->forget('redirectValue');
                $request->session()->put('redirectValue', $redirectValue);
                return redirect()->route('reply.review');
            }
        }
        // 忘掉帶到另一支function的section
        session()->forget('redirectValue');

        //獲取亂數表單
        $responseForm = Question::where('random', $id)->get();

        // 將找到的問卷裡面，題目那一欄(當時存成json)，解開
        $questionNaires = json_decode($responseForm[0]['questionnaires'], true);

        $response = [
            'responseForm' => $responseForm,
            'questionNaires' => $questionNaires,
        ];

        return Inertia::render('Frontend/ReplyIndex', ['response' => rtFormat($response)]);
    }
    public function reply_store(Request $request)
    {
        $user = $request->user();
        $formData = $request->formData;
        foreach ($formData as $key => $item) {
            if ($item['file']['name']) {
                $file = $this->fileService->fileUpload($item['file']['name'], 'FillerName');
                $formData[$key]['file'] = $file;
            }
        }
        $jsonText = json_encode($formData, JSON_UNESCAPED_UNICODE);
        Response::create([
            'user_id' => $user->id,
            'question_id' => $request->formId,
            'answer' => $jsonText,
        ]);
        // 如果使用者是主編者，不能重新修改問卷(避免抓到不同筆回覆的資料，帶到修改頁面的報錯情況)
        $cantModify = false;
        $updatedForm = Question::where('id', $request->formId)->first();
        $formTitle = $updatedForm['qu_naires_title'];
        $author = $updatedForm['lead_author_id'];
        if ($author === $user->id) {
            $cantModify = true;
        };
        // -------------------------------------
        $coworkers = Coworker::where('question_id', $request->formId)->get();
        // 將共同編輯者的id成一個陣列$coworkerArray
        $coworkerArray = [];
        foreach ($coworkers as $item) {
            $who = $item['coworker_id'];
            $coworkerArray[] = $who;
        }
        // 如果使用者是共同編輯者，也不能重新修改問卷(避免抓到不同筆回覆的資料，帶到修改頁面的報錯情況)
        if (in_array($request->user()->id, $coworkerArray)) {
            $cantModify = true;
        }

        $response = [
            'user_id' => $user->id,
            'question_id' => $request->formId,
            'formTitle' => $formTitle,
            'cantModify' => $cantModify,
        ];

        return Inertia::render('Frontend/ReplyFinal', ['response' => rtFormat($response)]);
    }
    public function reply_review(Request $request)
    {

        // -------第一種情況---填寫者之前填過問卷，又重新輸入問卷網址，也會被導向此function--------
        $redirectValue = $request->session()->get('redirectValue', '');

        if ($redirectValue) {
            // 先找到指定id的表單
            $responseForm = Question::where('id', $redirectValue['question_id'])->get();
            $questionNaires = json_decode($responseForm[0]['questionnaires'], true);

            // 找到該使用者的回覆
            $lastStore = Response::where('user_id', $redirectValue['user_id'])->where('question_id', $redirectValue['question_id'])->get();
            // 將找到的回覆裡面，答案那一欄(當時存成json)，解開
            $lastAnswer = json_decode($lastStore[0]['answer'], true);
            $response = [
                'responseForm' => $responseForm,
                'questionNaires' => $questionNaires,
                'lastAnswer' => $lastAnswer,
            ];

            return Inertia::render('Frontend/ReplyReview', ['response' => rtFormat($response)]);
        }

        // ------------第二種情況---填寫者第一次填完問卷後按「查看結果」回看問卷------------------

        // 先找到指定id的表單
        $responseForm = Question::where('id', $request->getOldResponse['question_id'])->get();
        $questionNaires = json_decode($responseForm[0]['questionnaires'], true);
        $response = [
            'responseForm' => $responseForm,
            'questionNaires' => $questionNaires,
        ];

        // 找到該使用者的回覆
        $lastStore = Response::where('user_id', $request->user()->id)->where('question_id', $request->getOldResponse['question_id'])->get();
        // 將找到的回覆裡面，答案那一欄(當時存成json)，解開
        $lastAnswer = json_decode($lastStore[0]['answer'], true);
        $response = [
            'responseForm' => $responseForm,
            'questionNaires' => $questionNaires,
            'lastAnswer' => $lastAnswer,
        ];

        return Inertia::render('Frontend/ReplyReview', ['response' => rtFormat($response)]);
    }

    public function reply_update(Request $request)
    {
        $updateForm = Response::where('user_id', $request->user()->id)->where('question_id', $request->formId)->get();
        $answer = json_decode($updateForm[0]['answer'], true);
        $formData = $request->formData;
        // 判斷有沒有修改上傳檔案(Object)是的話進行修改
        foreach ($formData as $key => $item) {
            if (is_object($item['file']['name'])) {
                $this->fileService->deleteUpload($answer[$key]['file']['path']);
                $file = $this->fileService->fileUpload($item['file']['name'], 'FillerName');
                $formData[$key]['file'] = $file;
            }
        }
        $jsonText = json_encode($formData, JSON_UNESCAPED_UNICODE);

        // 找到表單id
        $updateForm[0]->update([
            'user_id' => $request->user()->id,
            'question_id' => $request->formId,
            'answer' => $jsonText,
        ]);
        return back()->with(['message' => rtFormat($updateForm)]);
    }
    public function reply_final(Request $request)
    {
        $user = $request->user();
        $cantModify = false;
        $updatedForm = Question::where('id', $request->formId)->first();
        $formTitle = $updatedForm['qu_naires_title'];
        $author = $updatedForm['lead_author_id'];
        if ($author === $user->id) {
            $cantModify = true;
        };
        // -------------------------------------
        $coworkers = Coworker::where('question_id', $request->formId)->get();
        // 將共同編輯者的id成一個陣列$coworkerArray
        $coworkerArray = [];
        foreach ($coworkers as $item) {
            $who = $item['coworker_id'];
            $coworkerArray[] = $who;
        }
        // 如果使用者是共同編輯者，也不能重新修改問卷(避免抓到不同筆回覆的資料，帶到修改頁面的報錯情況)
        if (in_array($request->user()->id, $coworkerArray)) {
            $cantModify = true;
        }
        $response = [
            'user_id' => $user->id,
            'question_id' => $request->formId,
            'formTitle' => $formTitle,
            'cantModify' => $cantModify,
        ];
        return Inertia::render('Frontend/ReplyFinal', ['response' => rtFormat($response)]);
    }
}
