<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Question;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function reply_index_tzuchi(Request $request)
    {
        // 先找到指定id的表單
        $responseForm = Question::where('id', 8)->get();
        //獲取亂數表單
        //$question = Question::where('random', $random)->first();
        // dd($responseForm[0]['questionnaires']);
        // 將找到的問卷裡面，題目那一欄(當時存成json)，解開
        //    dd($responseForm );
        $questionNaires = json_decode($responseForm[0]['questionnaires'], true);
        // dd( $questionnaires);
        $response = [
            'responseForm' => $responseForm,
            'questionNaires' => $questionNaires,
        ];

        return Inertia::render('Frontend/reply_index_tzuchi', ['response' => rtFormat($response)]);
        //   return Inertia::render('Frontend/reply_index');
        // return Inertia::render('Backend/Guideindex', ['response' => rtFormat($Guide)]);
    }

}
