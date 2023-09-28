<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GuideController extends Controller
{
    public function guide_index(Request $request)
    {
        $Guide = Question::orderBy('id', 'desc')->where('lead_author_id', $request->user()->id)->get();
        // $Guide = Question::orderBy('id', 'desc')->get();
        // $id = $request->user()->id;
        // dd($Guide);
        return Inertia::render('Frontend/guide_index', ['response' => rtFormat($Guide)]);
    }
}
