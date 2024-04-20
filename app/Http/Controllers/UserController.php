<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    //
    public function create()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

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
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You are now logged out');
    }
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
    public function profile()
    {
        return view('profile');
    }
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

        // dd($formFields);
        return redirect('/home')->with('message', 'Profile updated successfully!');
        //hash password
        // $formFields['password'] = bcrypt(($formFields['password']));

        // $user = User::create($formFields);

        // event(new Registered($user));

        // auth()->login($user);
        // return redirect('/email/verify');

    }
}
