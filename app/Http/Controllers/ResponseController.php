<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Response;

class ResponseController extends Controller
{
    public function response_sum()
    {
        // dd(123);
        $datas = Response::where('question_id', 11)->get();
        $data = json_decode($datas[0]['answer'], true);
        return Inertia::render('Backend/ResponseSum', ['response' => rtFormat($data)]);
        return Inertia::render('Backend/ResponseSum');
    }
}
