<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Response;
use App\Models\Question;

class ResponseController extends Controller
{
    public function response_sum()
    {
        $datas = Response::where('question_id', 21)->get();
        $results = [];
        foreach ($datas as $data) {
            $answer = json_decode($data['answer'], true);
            $results[] = $answer;
        }
            $responseForm = Question::where('id', 21)->first();
            $questionNaires = json_decode($responseForm['questionnaires'], true);
            // $data = json_decode($datas[1]['answer'], true);
            // $responseForm = Question::where('id', 8)->first();
            // $questionNaires = json_decode($responseForm['questionnaires'], true);

            $response = [
                'results' => $results,
                'questionNaires' => $questionNaires,
            ];

            return Inertia::render('Backend/ResponseSum', ['response' => rtFormat($response)]);
    }
    public function responseQue(Request $request, $id) 
    {   
        $datas = Response::where('question_id', $id)->get();
        $results = [];
        foreach ($datas as $data) {
            $answer = json_decode($data['answer'], true);
            $results[] = $answer;
        }
        $response = [
            'results' => $results,
        ];
        return Inertia::render('Backend/ResponseQue',['response' => rtFormat($response)]);
    }
}
