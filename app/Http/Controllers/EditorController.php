<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Response;
use App\Models\Seeall;
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
        return Inertia::render('Backend/Question');
    }
    public function  edit_store(Request $request)
    {
        $user = $request->user();
        // dd($request->formText['qu_naires_title']);
        $request->validate([
            'formData.*.title' => 'required|string',
            'formData.*.type' => 'required|numeric',
            'formText.qu_naires_title' => 'required|string',
        ]);
        // dd(json_encode($request->formData, JSON_UNESCAPED_UNICODE));
        
        $jsonText = json_encode($request->formData, JSON_UNESCAPED_UNICODE);

        $textData = Question::create([
            'qu_naires_title' => $request->formText['qu_naires_title'],
            'qu_naires_desc' => $request->formText['qu_naires_desc'],
            'questionnaires' => $jsonText,
            'lead_author_id'=> $user->id,
        ]);

        return back()->with(['message' => rtFormat($textData)]);
    }
    public function  edit_old()
    {
        return Inertia::render('Backend/Editorold');
    }
}
