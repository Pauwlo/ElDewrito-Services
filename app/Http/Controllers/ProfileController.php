<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
            'name'    => 'required|string|max:32',
            'email'   => "required|email|unique:users,email,$user->id|max:255",
            'avatar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'discord' => 'nullable|string|min:7|max:37',
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

        if ($request->avatar)
        {
            $img = Image::make($request->avatar);

            $img->resize(null, 250, function ($constraint) {
                $constraint->aspectRatio();
            });

            $dateTime = Carbon::now()->toDateTimeString();
            $hash = md5($dateTime . $img->__toString());
            $fileName = $hash . '.' . request('avatar')->getClientOriginalExtension();
            $path = "/img/avatars/$fileName";

            $img->save(public_path() . $path);
            $user->avatar = $fileName;
            $user->save();
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

        $request->validate([
            'current-password' => 'required|string|min:8',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        if (!\Hash::check(request('current-password'), $user->password)) {
            return redirect()->back()->withErrors([
                'current-password' => __('Your current password is incorrect.')
            ]);
        }

        if (request('current-password') === request('password')) {
            return redirect()->back()->withErrors([
                'current-password' => __('Your new password can\'t be the same as your current password.')
            ]);
        }

        $user->password = \Hash::make(request('password'));
        $user->save();

        return redirect()->route('profile')->with('status', __('Password changed!'));
    }

    /**
     * Display a confirmation dialog before deleting the user account.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDeleteConfirmation()
    {
        return view('delete-account');
    }

    /**
     * Delete user account.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'password' => 'required|string|min:8'
        ]);

        if (!\Hash::check(request('password'), $user->password)) {
            return redirect()->back()->withErrors([
                'password' => __('Your current password is incorrect.')
            ]);
        }

        $user->delete();

        return redirect()->route('home')->with('status', __('Your account was deleted. You are now logged out.'));
    }
}
