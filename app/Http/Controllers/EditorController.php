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

        // dd(123);

        // $seeData = $request->input('see');
        // 將 see 數組轉換為 JSON 格式

        $seeJson = json_encode($request->see);

        $see = Seeall::create([
            'jsondata' => $seeJson,
        ]);
        dd(123);
        return back()->with(['message' => rtFormat($see)]);
    }
}
