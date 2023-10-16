<?php

namespace App\Http\Controllers;

use App\Models\Coworker;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Seeall;
use App\Models\Question;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\FileService;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Json;

use function PHPSTORM_META\type;

class EditorController extends Controller
{
    public function __construct(protected FileService $fileService)
    {
    }
    public function index()
    {
        return Inertia::render('Frontend/See');
    }
    public function edit_index(Request $request)
    {
        $response = $request->user();
        return Inertia::render('Backend/EditorIndex', ['response' => rtFormat($response)]);
    }
    public function edit_store(Request $request)
    {
        // 新表單頁面，點預覽，的情況
        if ($request->preview) {
            // 先做資料驗證，確認表單標題、問題標題、問題類型正確
            $request->validate([
                'formDataobj.*.title' => 'required|min:0',
                'formDataobj.*.type' => 'required|numeric',
                'formTextobj.qu_naires_title' => 'required|string',
            ], [
                'formDataobj.*.title.required' => '問題:position必填 ',
                'formTextobj.qu_naires_title.required' => '表單標題必填',
            ]);
            // 抓取使用者資料方便等下使用(因為以下情況1和2都會用到，所以寫這裡共用)
            $user = $request->user();

            // ******如果點預覽之前沒按儲存鈕，先儲存問卷資料，再導向填寫表單頁
            if ($request->coFormId === '0') {

                $data = Carbon::now()->locale('zh-tw')->format('YmdHms');
                // 產生再轉成16進位亂瑪(15字元)
                $randomString = bin2hex(random_bytes(15));
                $combinedString = $data . $randomString;

                // 處理圖片
                foreach ($request->formDataobj as $item) {
                    if ($item['image']) $this->fileService->base64Upload($request->image, 'editor');
                }

                // 將問卷資料壓成json
                $jsonText = json_encode($request->formDataobj, JSON_UNESCAPED_UNICODE);
                $this->fileService->base64Upload($request->image, 'editor');
                // 在資料表中新增一筆問卷資料
                $textData = Question::create([
                    'qu_naires_title' => $request->formTextobj['qu_naires_title'],
                    'qu_naires_desc' => $request->formTextobj['qu_naires_desc'],
                    'questionnaires' => $jsonText,
                    'lead_author_id' => $user->id,
                    'random' => $combinedString,
                ]);
                // 將新增的問卷資料id取出
                $newForm = Question::where('lead_author_id', $request->user()->id)->orderBy('created_at', 'desc')
                    ->first();
                $newFormId = $newForm['id'];

                $response = [
                    'combinedString' => $combinedString,
                    'id' => $newFormId,
                ];
                // 前往空白問卷填寫頁，帶問卷id，才能前往正確的頁面
                return redirect()->route('reply.index', ['id' => $newFormId]);
            }

            // ******如果導向預覽前已按儲存鈕，則做完資料更新後，直接前往預覽頁，不用再儲存一筆問卷資料
            foreach ($request->formDataobj as $item) {
                $item['image'] = $this->fileService->base64Upload($request->image, 'editor');
            }

            $jsonText = json_encode($request->formDataobj, JSON_UNESCAPED_UNICODE);
            $this->fileService->base64Upload($request->image, 'editor');
            // 用layout傳過來的問卷Id找到要更新資料的問卷
            $upDatedForm = Question::find($request->coFormId);

            // 將問卷資料做更新
            $upDatedForm->update([
                'qu_naires_title' => $request->formTextobj['qu_naires_title'],
                'qu_naires_desc' => $request->formTextobj['qu_naires_desc'],
                'questionnaires' => $jsonText,
                'lead_author_id' => $user->id,
            ]);
            // 前往空白問卷填寫頁，帶問卷id，才能前往正確的頁面
            return redirect()->route('reply.index', ['id' => $request->coFormId]);
        }
        // 與當下時間
        $data = Carbon::now()->locale('zh-tw')->format('YmdHms');
        // 產生再轉成16進位亂瑪(15字元)
        $randomString = bin2hex(random_bytes(15));
        $combinedString = $data . $randomString;
        $user = $request->user();
        $request->validate([
            'formData.*.title' => 'required|min:0',
            'formData.*.type' => 'required|numeric',
            'formText.qu_naires_title' => 'required|string',
        ], [
            'formData.*.title.required' => '問題:position必填 ',
            'formText.qu_naires_title.required' => '表單標題必填',
        ]);
        // :position 第幾個意思
        // 處理圖片
        foreach ($request->formData as $item) {
            $item['image'] = $this->fileService->base64Upload($request->image, 'editor');
        }
        $jsonText = json_encode($request->formData, JSON_UNESCAPED_UNICODE);
        $this->fileService->base64Upload($request->image, 'editor');
        $textData = Question::create([
            'qu_naires_title' => $request->formText['qu_naires_title'],
            'qu_naires_desc' => $request->formText['qu_naires_desc'],
            'questionnaires' => $jsonText,
            'lead_author_id' => $user->id,
            'random' => $combinedString,
        ]);

        $newForm = Question::where('lead_author_id', $request->user()->id)->orderBy('created_at', 'desc')
            ->first();
        $newFormId = $newForm['id'];
        $response = [
            'combinedString' => $combinedString,
            'id' => $newFormId,

        ];
        return back()->with(['message' => rtFormat($response)]);
    }
    public function edit_old(Request $request)
    {

        // dd($request->id,123);
        if ($request->id === '0') {
            $response = $request->user();
            return Inertia::render('Backend/EditorIndex', ['response' => rtFormat($response)]);
        }

        $responseForm = Question::where(function ($query) use ($request) {
            return $query->where('lead_author_id', $request->user()->id)
                ->orWhereHas('coworker', function ($coQuery) use ($request) {
                    return $coQuery->where('coworker_id', $request->user()->id);
                });
        })->find($request->id);

        if (!session()->get('update_token') == $request->id) {
            $responseForm->update([
                'opened_date' => Carbon::now(),
            ]);
        }

        session()->forget('update_token');

        // 將找到的問卷裡面，題目那一欄(當時存成json)，解開
        $questionNaires = json_decode($responseForm['questionnaires'], true);
        $response = [
            'responseForm' => $responseForm,
            'questionNaires' => $questionNaires,
        ];
        return Inertia::render('Backend/EditorOld', ['response' => rtFormat($response)]);
    }
    public function edit_update(Request $request)
    {
        $request->validate([
            'formData.*.title' => 'required|string',
            'formData.*.type' => 'required|numeric',
            'formText.qu_naires_title' => 'required|string',
        ], [
            'formData.*.title.required' => '問題:position必填 ',
            'formText.qu_naires_title.required' => '表單標題必填',
        ]);

        $jsonText = json_encode($request->formData, JSON_UNESCAPED_UNICODE);

        // 找到表單id
        $updateForm = Question::where(function ($query) use ($request) {
            return $query->where('lead_author_id', $request->user()->id)
                ->orWhereHas('coworker', function ($coQuery) use ($request) {
                    return $coQuery->where('coworker_id', $request->user()->id);
                });
        })->find($request->formText['id']);


        // 處理圖片
        foreach ($request->formData as $item) {
            $item['image'] = $this->fileService->base64Upload($request->image, 'editor');
        }
        $updateForm->update([
            'qu_naires_title' => $request->formText['qu_naires_title'],
            'qu_naires_desc' => $request->formText['qu_naires_desc'],
            'questionnaires' => $jsonText,
            'modified_at' => Carbon::now(),
        ]);
        // dd(132);
        return back()->with(['message' => rtFormat($updateForm), 'update_token' => $request->formText['id']]);
    }
    public function edit_delete(Request $request)
    {

        // 處理----從表單編輯頁面刪除表單----的情況
        if($request->deleteFormId){
            $formDel = Question::find($request->deleteFormId);
            $ansdel = Response::where('question_id', $request->deleteFormId)->get();
            foreach ($ansdel as $key => $value) {
                $answer = json_decode($value['answer'], true);
                if ($answer[$key]['file']['name']) {
                    $this->fileService->deleteUpload($answer[$key]['file']['path']);
                }
                $value->delete();
            }
            $formDel->delete();
            return redirect()->route('guide.index');
        };
         // 處理----從導覽頁面刪除表單----的情況
         if($request->id){
            $formDel = Question::find($request->id);
            $ansdel = Response::where('question_id', $request->id)->get();
            foreach ($ansdel as $key => $value) {
                $answer = json_decode($value['answer'], true);
                if ($answer[$key]['file']['name']) {
                    $this->fileService->deleteUpload($answer[$key]['file']['path']);
                }
                $value->delete();
            }
            $formDel->delete();
            return back()->with(['message' => rtFormat($formDel)]);
         }

    }
    public function edit_rename(Request $request)
    {
        $request->validate([
            'modalData.newName' => 'required|max:255'
        ]);

        $updateForm = Question::find($request->modalData['id']);
        $updateForm->update([
            'qu_naires_title' => $request->modalData['newName']
        ]);
        return back()->with(['message' => rtFormat($updateForm)]);
    }
    public function edit_addSameForm(Request $request)
    {
        $request->validate([
            'newFormName' => 'required|string',
        ], [
            'newFormName.required' => '請填入新表單名稱 ',
        ]);
        // dd($request->sameCallaborator);
        $motherForm = Question::find($request->sameFormId);
        $data = Carbon::now()->locale('zh-tw')->format('YmdHms');
        // 產生再轉成16進位亂瑪(15字元)
        $randomString = bin2hex(random_bytes(15));
        $combinedString = $data . $randomString;
        $user = $request->user();

        $SameForm = Question::create([
            'qu_naires_title' => $request->newFormName,
            'qu_naires_desc' => $motherForm['qu_naires_desc'],
            'questionnaires' => $motherForm['questionnaires'],
            'lead_author_id' => $user->id,
            'random' => $combinedString,
        ]);

        if($request->sameCallaborator){
            // dd(123);
            $allCoworker=Coworker::where('question_id',$request->sameFormId)->get();
            // dd( $allCoworker);
            $copyCoworker = [];
            foreach ($allCoworker as $coworker) {
                // dump($coworker);
                $cowork = $coworker['coworker_id'];
                $copyCoworker[] = $cowork;
            }
            // dd($copyCoworker);
            foreach ($copyCoworker as $copy) {
                // dump($copy);
                $worker=Coworker::create([
                    'question_id' => $SameForm['id'],
                    'coworker_id' => $copy,
                ]);
                // dd($worker);
            }


        }

        return back()->with(['message' => rtFormat( $SameForm)]);
    }

    public function coformid_index(Request $request)
    {
        if ($request->coFormId) {
            // 利用關聯user找到 user=>id
            $ownerids = Question::with('user')->where('id', $request->coFormId)->first();
            $ownerid = $ownerids->user;
            // 利用關聯user找到 user=>id
            $formIds = Coworker::with('user')->where('question_id', $request->coFormId)->get();
            // dd($ownerid);
            return back()->with(['message' => rtFormat([$formIds, $ownerid])]);
        }
        $formIds = $request->user();
        return back()->with(['message' => rtFormat([$formIds])]);
    }

    public function coformid_store(Request $request)
    {
        $user = User::select('email', 'id')->where('email', $request->co_email)->first();
        // 登入帳號不能填入自己email
        if ($request->user()->email === $request->co_email) {
            return redirect()->route('edit.old', ['id' => $request->coFormIdNumber])->with(['message' => rtFormat($user, 0, '已擁有編輯使用者')]);
        }
        // 找不到email跳出
        if (!$user) {
            return redirect()->route('edit.old', ['id' => $request->coFormIdNumber])->with(['message' => rtFormat($user, 0, '查無資料')]);
        }
        $repeatid = Coworker::where('coworker_id', $user->id)->get();
        // 找到此表單有一樣email就跳出
        foreach ($repeatid as $index) {
            if ($index->question_id === $request->coFormIdNumber) {
                return redirect()->route('edit.old', ['id' => $request->coFormIdNumber])->with(['message' => rtFormat($user, 0, '已擁有編輯使用者')]);
            }
        }
        $formId = Coworker::create([
            'question_id' => $request->coFormIdNumber,
            'coworker_id' => $user->id,
        ]);
        return back()->with(['message' => rtFormat($formId)]);
    }

    public function coformidDelete(Request $request)
    {
        $codelete = Coworker::find($request->id);
        $codelete->delete();
        return back()->with(['message' => rtFormat($codelete)]);
    }
}
