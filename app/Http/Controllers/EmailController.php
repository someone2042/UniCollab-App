<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    //
    public function verify_email()
    {
        return view('auth-verify-email');
    }
    public function handel_email_verification(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/main')->with('message', 'your email is confirmed!!');
    }
}
