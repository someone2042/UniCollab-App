<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\File;
use App\Models\User;
use App\Models\Group;
use App\Models\Message;
use App\Mail\RemoveMail;
use App\Models\Groupmessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminiController extends Controller
{
    //
    public function index()
    {
        return view(
            'admin.dashboard',
            [
                'userscount' => User::count(),
                'groupscount' => Group::count(),
                'messages' => Message::count() + Groupmessage::count(),
                'projects' => File::count(),
                'users' => User::all(),
                'groups' => Group::all(),
            ]
        );
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authentication(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/admin/dashboard')->with('message', 'You are now logged in');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function update(Request $request)
    {
        // dd(request()->all());
        $user = auth('admin')->user();
        // dd($user);

        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|confirmed|min:6'
        ]);

        if ($formFields['password'] != NUll) {
            $formFields['password'] = bcrypt(($formFields['password']));
        } else {
            // Remove password from formFields if it's empty
            unset($formFields['password']);
        }
        // dd($formFields);
        $user->update($formFields);

        return redirect('/admin/dashboard')->with('message', 'Your profile has been updated!');
    }

    public function removeUser(User $user)
    {
        // dd($user);
        Mail::to($user->email)->send(new RemoveMail($user->name));
        $user->delete();
        return redirect('/admin/dashboard')->with('message', 'User has been deleted!');
    }
}
