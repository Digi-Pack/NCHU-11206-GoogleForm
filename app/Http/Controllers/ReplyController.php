<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Question;

class ReplyController extends Controller
{

    public function reply_index(Request $request)
    {
        // 先找到指定id的表單
        $responseForm = Question::where('id', 14)->get();
        
        $url = route('reply.index', ['random' => 'your_random_value']); 
        //獲取亂數表單
        //$question = Question::where('random', $random)->first();
        // dd($responseForm[0]['questionnaires']);
        // 將找到的問卷裡面，題目那一欄(當時存成json)，解開
        //    dd($responseForm );
        $questionNaires = json_decode($responseForm[0]['questionnaires'], true);
        // dd( $questionnaires);
        $response = [
            'responseForm' => $responseForm,
            'questionNaires' => $questionNaires,
        ];

        return Inertia::render('Frontend/reply_index', ['response' => rtFormat($response)]);
        //   return Inertia::render('Frontend/reply_index');
        // return Inertia::render('Backend/Guideindex', ['response' => rtFormat($Guide)]);
    }
}
