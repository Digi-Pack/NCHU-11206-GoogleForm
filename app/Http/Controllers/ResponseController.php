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
        // dd(123);
        $datas = Response::where('question_id', 18)->get();
        // dd($datas);
        $data = json_decode($datas[0]['answer'], true);

        return Inertia::render('Tzuchi-try/Echarts', ['response' => rtFormat($data)]);
        // return Inertia::render('Backend/ResponseSum');
    }
    //  public function response_sum(Request $request)
    // {
    //     $datas = Response::where('question_id', 18)->get();
    //     $data = json_decode($datas[0]['answer'], true);
    //     return Inertia::render('Backend/ResponseSum', ['response' => rtFormat($data)]);
    // }
    public function response_sum()
    {
     $datas = Response::where('question_id', 19)->get();
            $results = [];
            foreach ($datas as $data) {
                $answer = json_decode($data['answer'], true);
                $results[] = $answer;
            }
            // $data = json_decode($datas[1]['answer'], true);
            $responseForm = Question::where('id', 19)->first();
            $questionNaires = json_decode($responseForm['questionnaires'], true);

            $response=[
                'results' => $results,
                'questionNaires' => $questionNaires,
            ];

            // dd($response);

            return Inertia::render('Backend/ResponseSum',['response' => rtFormat($response)]);
    }
}
