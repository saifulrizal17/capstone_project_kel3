<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\User;
use Mail;
use Hash;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->exists();

        if (!$user) {
            return back()->with('errorMessage', 'Email tidak dapat ditemukan!');
        } else {
            $token = Str::random(60);

            DB::table('tbl_password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::send('auth.email.forgot', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            return back()->with('success', 'Kita sudah mengirimkan Link untuk mereset password email Anda!');
        }
    }

    /**
     * Show the form to reset the password.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function showResetPasswordForm($token)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => request('email')]
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPasswordForm(Request $request)
    {
        $updatePassword = DB::table('tbl_password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('tbl_password_resets')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('success', 'Password Sudah Diganti!');
    }
}
