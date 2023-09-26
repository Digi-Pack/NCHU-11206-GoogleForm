<?php

namespace App\Http\Controllers;

use App\Models\Seeall;
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
        ]);

        dd(123);

        // $seeData = $request->input('see');
        // 將 see 數組轉換為 JSON 格式
        $seeJson = json_encode($request->see);

        $see = Seeall::create([
            'jsondata' => $seeJson,
        ]);
        return back()->with(['message' => rtFormat($see)]);
    }
}
