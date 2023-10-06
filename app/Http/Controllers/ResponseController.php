<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Response;

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
     public function response_sum(Request $request)
    {
        $datas = Response::where('question_id', 18)->get();
        $data = json_decode($datas[0]['answer'], true);
        return Inertia::render('Backend/ResponseSum', ['response' => rtFormat($data)]);
    }
}
