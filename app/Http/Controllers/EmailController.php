<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/**
 * Handles email verification related actions.
 */
class EmailController extends Controller
{
    /**
     * Displays the email verification notice.
     *
     * This method is typically called when a user is not verified 
     * and tries to access a protected resource.
     * 
     * @return \Illuminate\View\View
     */
    public function verify_email()
    {
        // Returns the 'auth-verify-email' view. This view should
        // guide the user to check their email for a verification link.
        return view('auth-verify-email');
    }

    /**
     * Handles the email verification request.
     *
     * This method is called when the user clicks the verification link
     * sent to their email address. 
     * 
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handel_email_verification(EmailVerificationRequest $request)
    {
        // Marks the user's email as verified in the database.
        $request->fulfill();

        // Redirects the user to the '/home' route with a success message.
        return redirect('/home')->with('message', 'your email is confirmed!!');
    }
}
