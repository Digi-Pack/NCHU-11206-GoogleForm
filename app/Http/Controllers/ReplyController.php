<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\Response;

class ReplyController extends Controller
{
    public function reply_index(Request $request, $id)
    {
        // dd($id);
        $responseForm = Question::where('id', $id)->get();
        // 當自己是主編者時，可以訪問填寫問卷頁
        if (!$responseForm->isEmpty()){
            if ($request->user()->id == $responseForm[0]['lead_author_id']) {
            $questionNaires = json_decode($responseForm[0]['questionnaires'], true);
            $response = [
                'responseForm' => $responseForm,
                'questionNaires' => $questionNaires,
            ];
            return Inertia::render('Frontend/reply_index', ['response' => rtFormat($response)]);
        }
        }

        $responseForm = Question::where('random', $id)->get();
         // 查詢回覆資料庫中，是否有該使用者填寫過的該份問卷(暫時設定為第x份問卷)
        if (!$responseForm->isEmpty()) {
            $hasBeen = Response::where('user_id', $request->user()->id)->where('question_id', $responseForm[0]['id'])->get();
            if (!$hasBeen->isEmpty()) {
                        // 如果有，則前往修改答案的頁面
                        //   dd($hasBeen);
                        $redirectValue = [
                            'user_id' => $request->user()->id,
                            'question_id' => $responseForm[0]['id'],
                        ];
                        // dd( $redirectValue );
                        session()->forget('redirectValue');
                        $request->session()->put('redirectValue', $redirectValue);
                        return redirect()->route('reply.review'); // 这里进vend行重定向
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

        return Inertia::render('Frontend/reply_index', ['response' => rtFormat($response)]);
        //   return Inertia::render('Frontend/reply_index');
        // return Inertia::render('Backend/Guideindex', ['response' => rtFormat($Guide)]);
    }
    public function reply_store(Request $request)
    {

        $user = $request->user();
        $jsonText = json_encode($request->formData, JSON_UNESCAPED_UNICODE);

        Response::create([
           'user_id' => $user->id,
            'question_id' => $request-> formId,
            'answer' => $jsonText ,
        ]);
        $response = [
            'user_id' => $user->id,
            'question_id' => $request-> formId,
        ];

        return Inertia::render('Frontend/reply_final', ['response' => rtFormat($response)]);
    }
    public function reply_review(Request $request)
    {

        // -------第一種情況---填寫者之前填過問卷，又重新輸入問卷網址，也會被導向此function--------
        $redirectValue = $request->session()->get('redirectValue', '');

        if ($redirectValue) {
             // 先找到指定id的表單
        // dd(123);
            $responseForm = Question::where('id', $redirectValue['question_id'])->get();
         //  dd( $responseForm);

            $questionNaires = json_decode($responseForm[0]['questionnaires'], true);
          // dd( $questionnaires);
            $response = [
              'responseForm' => $responseForm,
              'questionNaires' => $questionNaires,
            ];

         // 找到該使用者的回覆
            $lastStore = Response::where('user_id', $redirectValue['user_id'])->where('question_id', $redirectValue['question_id'])->get();
         // dd($responseForm[0]['questionnaires']);
         // 將找到的回覆裡面，答案那一欄(當時存成json)，解開
            $lastAnswer = json_decode($lastStore[0]['answer'], true);
         // dd( $questionnaires);
         // dd($lastAnswer);
            $response = [
             'responseForm' => $responseForm,
             'questionNaires' => $questionNaires,
             'lastAnswer' => $lastAnswer,
            ];

            return Inertia::render('Frontend/reply_review', ['response' => rtFormat($response)]);
        }

        // ------------第二種情況---填寫者第一次填完問卷後按「查看結果」回看問卷------------------

         // 先找到指定id的表單
         $responseForm = Question::where('id', $request->getOldResponse['question_id'])->get();
        //  dd( $responseForm);

        //  $responseForm = Question::where('id', 2)->get();
         $questionNaires = json_decode($responseForm[0]['questionnaires'], true);
         // dd( $questionnaires);
         $response = [
             'responseForm' => $responseForm,
             'questionNaires' => $questionNaires,
         ];

        // 找到該使用者的回覆
         $lastStore = Response::where('user_id', $request->user()->id)->where('question_id', $request->getOldResponse['question_id'])->get();
        // dd($responseForm[0]['questionnaires']);
        // 將找到的回覆裡面，答案那一欄(當時存成json)，解開
         $lastAnswer = json_decode($lastStore[0]['answer'], true);
        // dd( $questionnaires);
        // dd($lastAnswer);
         $response = [
            'responseForm' => $responseForm,
            'questionNaires' => $questionNaires,
            'lastAnswer' => $lastAnswer,
         ];

         return Inertia::render('Frontend/reply_review', ['response' => rtFormat($response)]);
    }

    public function reply_update(Request $request)
    {
        // dd($request);
        $jsonText = json_encode($request->formData, JSON_UNESCAPED_UNICODE);

        // 找到表單id
        // dd($request->formText['id']);
        // dd($request->formData);
        // dd($request->user()->id, $request->formId);
        $updateForm = Response::where('user_id', $request->user()->id)->where('question_id', $request->formId)->get();
        // dd($request->user()->id, $request->formId,$updateForm,$updateForm[0]);
        $updateForm[0]->update([
            'user_id' => $request->user()->id,
            'question_id' => $request->formId,
            'answer' => $jsonText,
        ]);
        // dd(132);
        return back()->with(['message' => rtFormat($updateForm)]);
    }
}
