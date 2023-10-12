<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Coworker;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GuideController extends Controller
{
    public function guide_index(Request $request)
    {
        $guide = Question::query();
        $guide->where('qu_naires_title', 'like', '%' . $request->keyword . '%')->get();

        if ($request->filled('owner')) {
            $owner = $request->owner;
            if ($owner == 1) {
                // 不限擁有者
                $guide->where('lead_author_id', $request->user()->id)
                    ->orWhereHas('coworker', function ($query) use ($request) {
                        return $query->where('coworker_id', $request->user()->id);
                    });
            } elseif ($owner == 2) {
                // 我所擁有
                $guide->where('lead_author_id', $request->user()->id);
            } else {
                // 不歸我所有
                $guide->whereHas('coworker', function ($query) use ($request) {
                    return $query->where('coworker_id', $request->user()->id);
                });
            }
        }
        if ($request->filled('sort')) {
            $sort = $request->sort;
            if ($sort == 1) {
                // 我上次開啟的時間
                $guide->orderBy('opened_date', 'desc');
            } elseif ($sort == 2) {
                // 我上次修改的時間
                $guide->orderBy('modified_at', 'desc');
            } elseif ($sort == 3) {
                // 上次修改的時間
                $guide->orderBy('updated_at', 'desc');
            } else {
                // 標題
                $guide->orderBy('qu_naires_title', 'asc');
            }
            $guide = $guide->get();
        }

        if (!$request->filled('sort') && !$request->filled('owner')) {
            $guide = $guide->where('lead_author_id', $request->user()->id)->orWhereHas('coworker', function ($query) use ($request) {
                return $query->where('coworker_id', $request->user()->id);
            })->orderBy('opened_date', 'desc')->get();
        }
        $response = [
            'guide' => $guide,
            'user' => $request->user(),
        ];
        return Inertia::render('Frontend/GuideIndex', ['response' => rtFormat($response)]);
    }
}
