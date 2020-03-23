<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return view('profile', compact('user'));
    }

    /**
     * Update the user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:32',
            'email' => "required|email|unique:users,email,$user->id|max:255",
        ]);

        $oldEmail = $user->email;

        $user->update(request([
            'name',
            'email',
        ]));

        if ($user->email != $oldEmail)
        {
            $user->setEmailAsUnverified();
            $user->sendEmailVerificationNotification();
        }

        return view('profile', compact('user'));
    }
}
