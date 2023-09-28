<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Response;
use App\Models\Seeall;
use Carbon\Carbon;
use Egulias\EmailValidator\Result\Reason\Reason;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;


class EditorController extends Controller
{
    public function index()
    {
        return Inertia::render('Frontend/See');
    }

    public function seeStore(Request $request)
    {
        $request->validate([
            'see.*.title' => 'required|string',
            'see.*.desc' => 'string',
            'see.*.request' => 'required|numeric',
            'see.*.image' => 'string',
            'see.*.vedio' => 'string',
            'see.*.type' => 'numeric',
            // 如何驗證陣列裡物件裡的東西?
            // 'see.*.options' => '',
            // 'see.*.linear' => '',
            // 'see.*.square' => '',
        ], [
            'see.*.title.required' => '問題名稱必填',
            'see.*.title.string' => '請輸入文字',
        ]);

        // $seeData = $request->input('formData');
        // 將 see 數組轉換為 JSON 格式

        $seeJson = json_encode($request->formData);
        $see = Question::create([
            'modified_at' => $request->Dataall['modified_at'],
            'other_modified' => $request->Dataall['other_modified'],
            'opened_date' => $request->Dataall['opened_date'],
            'lead_author_id' => $request->Dataall['lead_author_id'],
            'qu_naires_title' => $request->Dataall['qu_naires_title'],
            'qu_naires_desc' => $request->Dataall['qu_naires_desc'],
            'questionnaires' => $seeJson,
        ]);


        $data = Response::create([
            'user_id' => $request->resPonse[0]['user_id'],
            'question_id' => $request->resPonse[0]['question_id'],
            'answer' => $seeJson,
        ]);

        dd(Question::with('response')->find(2));


        return back()->with(['message' => rtFormat($see)]);
    }

    public function  edit_index()
    {
        return Inertia::render('Backend/Editorindex');
    }
    public function  edit_store(Request $request)
    {
        // 與當下時間
        $data = Carbon::now()->locale('zh-tw')->format('YmdHms');
        // 產生再轉成16進位亂瑪(15字元)
        $randomString = bin2hex(random_bytes(15));
        $combinedString = $data . $randomString;
        $user = $request->user();
        // dd($request->formText['qu_naires_title']);
        $request->validate([
            'formData.*.title' => 'required|min:0',
            'formData.*.type' => 'required|numeric',
            'formText.qu_naires_title' => 'required|string',
        ],[
            'formData.*.title.required' => '問題:position必填 ',
            'formText.qu_naires_title.required' => '表單標題必填',
        ]);
        // :position 第幾個意思
        // dd(json_encode($request->formData, JSON_UNESCAPED_UNICODE));

        $jsonText = json_encode($request->formData, JSON_UNESCAPED_UNICODE);

        $textData = Question::create([
            'qu_naires_title' => $request->formText['qu_naires_title'],
            'qu_naires_desc' => $request->formText['qu_naires_desc'],
            'questionnaires' => $jsonText,
            'lead_author_id' => $user->id,
            'random' => $combinedString,
        ]);

        return back()->with(['message' => rtFormat($textData)]);
    }
    public function  edit_old(Request $request)
    {

        // 先找到該用戶自己的表單，再找到指定id的表單，避免猜網址
        $responseForm = Question::where('lead_author_id', $request->user()->id)->where('id', $request->id)->get();
        // dd($responseForm[0]['questionnaires']);
        // 將找到的問卷裡面，題目那一欄(當時存成json)，解開
        $questionNaires = json_decode($responseForm[0]['questionnaires'], true);
        // dd( $questionnaires);
        $response = [
            'responseForm' => $responseForm,
            'questionNaires' => $questionNaires,
        ];

        return Inertia::render('Backend/Editorold', ['response' => rtFormat($response)]);
    }
    public function  edit_update(Request $request)
    {

        $request->validate([
            'formData.*.title' => 'required|string',
            'formData.*.type' => 'required|numeric',
            'formText.qu_naires_title' => 'required|string',
        ]);
        // dd(json_encode($request->formData, JSON_UNESCAPED_UNICODE));

        $jsonText = json_encode($request->formData, JSON_UNESCAPED_UNICODE);

        // 找到表單id
        // dd($request->formText['id']);
        // dd($request->formData);
        $updateForm = Question::where('lead_author_id', $request->user()->id)->find($request->formText['id']);
        // dd($updateForm);
        $updateForm->update([
            'qu_naires_title' => $request->formText['qu_naires_title'],
            'qu_naires_desc' => $request->formText['qu_naires_desc'],
            'questionnaires' => $jsonText,
        ]);
        // dd(132);
        return back()->with(['message' => rtFormat($updateForm)]);
    }
}
