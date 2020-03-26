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
            'discord' => 'nullable|string|min:7|max:37'
        ]);

        $oldEmail = $user->email;

        $user->update(request([
            'name',
            'email',
            'discord',
        ]));

        if ($user->email != $oldEmail)
        {
            $user->setEmailAsUnverified();
            $user->sendEmailVerificationNotification();
        }

        return redirect()->route('profile')->with('status', __('Profile updated!'));
    }

    /**
     * Display change password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showChangePassword()
    {
        return view('auth.passwords.change');
    }

    /**
     * Update user password.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $user = auth()->user();

        if (!\Hash::check(request('current-password'), $user->password)) {
            return redirect()->back()->withErrors([
                'current-password' => __('Your current password is incorrect.')
            ]);
        }

        $request->validate([
            'current-password' => 'required|string|min:8',
            'password'         => "required|string|min:8|confirmed"
        ]);

        if (request('current-password') === request('password')) {
            return redirect()->back()->withErrors([
                'current-password' => __('Your new password can\'t be the same as your current password.')
            ]);
        }

        $user->password = \Hash::make(request('password'));
        $user->save();

        return redirect()->route('profile')->with('status', __('Password changed!'));
    }
}
