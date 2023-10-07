<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Response;
use App\Models\Question;

class ResponseController extends Controller
{
    public function response_tzuchi()
    {
        $datas = Response::where('question_id', 18)->get();
        $data = json_decode($datas[0]['answer'], true);

        return Inertia::render('Tzuchi-try/Echarts', ['response' => rtFormat($data)]);
    }
    public function response_sum()
    {
     $datas = Response::where('question_id', 12)->get();
    //  dd($datas);
            $results = [];
            foreach ($datas as $data) {
                $answer = json_decode($data['answer'], true);
                $results[] = $answer;
            }
            $responseForm = Question::where('id', 12)->first();
            $questionNaires = json_decode($responseForm['questionnaires'], true);

            $response=[
                'results' => $results,
                'questionNaires' => $questionNaires,
            ];

            return Inertia::render('Backend/ResponseSum',['response' => rtFormat($response)]);
    }
}
