<?php

namespace App\Http\Controllers;

use App\Models\Seeall;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        return Inertia::render('Frontend/See');
    }

    public function indexStore(Request $request)
    {
        $data = $request->json()->all();
        // $data = json_decode($request->input('jsonData'), true);
        // 定义验证规则
        $rules = [
            'title' => 'required|string',
        ];

        // 创建一个验证实例并应用规则
        $validator = Validator::make($data, $rules);

        // 检查验证是否通过
        // if ($validator->fails()) {
        //     // 验证失败，可以返回错误消息或采取其他措施
        //     return response()->json(['errors' => $validator->errors()], 400);
        // }
        // dd($request->jsonData);
        $see = Seeall::create([
            'jsondata' => $request->jsonData,
        ]);
        return back()->with(['message' => rtFormat($see)]);
   }
}
