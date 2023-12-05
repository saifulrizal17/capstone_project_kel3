<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgetPasswordController extends Controller
{
    use SendsPasswordResetEmails;

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
        $this->validateEmail($request);

        $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return back()->with('status', trans('passwords.sent'));
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
        $request->validate($this->rules(), $this->validationErrorMessages());

        $this->reset($request);

        return redirect($this->redirectPath())
            ->with('status', trans('passwords.reset'));
    }
}
