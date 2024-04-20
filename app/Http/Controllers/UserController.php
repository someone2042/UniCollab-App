<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

/*
|--------------------------------------------------------------------------
| User Controller
|--------------------------------------------------------------------------
|
| This controller handles the registration and authentication of users.
| It also handles the updating of user information and email verification.
|
*/

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create a new user
    |--------------------------------------------------------------------------
    |
    | This method creates a new user and stores the user information in the
    | database. It also logs in the user and redirects the user to the email
    | verification page.
    |
    */
    public function create()
    {
        return view('register');
    }

    /*
    |--------------------------------------------------------------------------
    | Log in a user
    |--------------------------------------------------------------------------
    |
    | This method logs in a user and redirects the user to the home page.
    |
    */
    public function login()
    {
        return view('login');
    }

    /*
    |--------------------------------------------------------------------------
    | Store a new user
    |--------------------------------------------------------------------------
    |
    | This method validates the user input, hashes the password, creates a new
    | user, logs in the user, and redirects the user to the email verification
    | page.
    |
    */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);
        //hash password
        $formFields['password'] = bcrypt(($formFields['password']));

        $user = User::create($formFields);

        event(new Registered($user));

        auth()->login($user);
        return redirect('/email/verify');
    }

    /*
    |--------------------------------------------------------------------------
    | Log out a user
    |--------------------------------------------------------------------------
    |
    | This method logs out a user, invalidates the session, and regenerates the
    | session token. It then redirects the user to the home page with a success
    | message.
    |
    */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You are now logged out');
    }

    /*
    |--------------------------------------------------------------------------
    | Authenticate a user
    |--------------------------------------------------------------------------
    |
    | This method authenticates a user and redirects the user to the home page
    | with a success message. If the authentication fails, it redirects the user
    | back to the login page with an error message.
    |
    */
    public function authentication(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/home')->with('message', 'You are now logged in');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | Display the user profile
    |--------------------------------------------------------------------------
    |
    | This method displays the user profile.
    |
    */
    public function profile()
    {
        return view('profile');
    }

    /*
    |--------------------------------------------------------------------------
    | Update the user information
    |--------------------------------------------------------------------------
    |
    | This method validates the user input, updates the user information in the
    | database, and redirects the user to the home page with a success message.
    | If the email is changed, it also updates the email verification status.
    |
    */
    public function update(Request $request, User $user)
    {
        // dd(request()->all());
        $user = auth()->user();

        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            // 'email' => ['required', 'email', Rule::unique('users', 'email')],
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|confirmed|min:6'
        ]);

        if ($formFields['password'] != NUll) {
            $formFields['password'] = bcrypt(($formFields['password']));
        } else {
            // Remove password from formFields if it's empty
            unset($formFields['password']);
        }
        if ($request->hasFile('fileToUpload')) {
            $formFields['profile_url'] = $request->file('fileToUpload')->store('profile', 'public');
        }

        $oldEmail = $user->email;

        $user->update($formFields);

        if ($user->email != $oldEmail) {
            $user->email_verified_at = null;
            $user->save();

            event(new Registered($user));
        }

        return redirect('/home')->with('message', 'Your profile has been updated!');
    }
}
