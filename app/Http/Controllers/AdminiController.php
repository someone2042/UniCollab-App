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
use App\Mail\RemoveGroupMail;
use Illuminate\Support\Facades\Mail;

class AdminiController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve counts for various entities
        $usersCount = User::count();
        $groupsCount = Group::count();
        $messagesCount = Message::count() + Groupmessage::count();
        $projectsCount = File::count();

        // Retrieve all users and groups
        $users = User::all();
        $groups = Group::all();

        // Return the dashboard view with the retrieved data
        return view(
            'admin.dashboard',
            [
                'userscount' => $usersCount,
                'groupscount' => $groupsCount,
                'messages' => $messagesCount,
                'projects' => $projectsCount,
                'users' => $users,
                'groups' => $groups,
            ]
        );
    }

    /**
     * Show the admin login form.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('admin.login');
    }

    /**
     * Handle admin authentication.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authentication(Request $request)
    {
        // Validate the login form data
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        // Attempt to authenticate the admin
        if (Auth::guard('admin')->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/admin/dashboard')->with('message', 'You are now logged in');
        }

        // Authentication failed, redirect back with errors
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    /**
     * Log the admin out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    /**
     * Show the admin profile page.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Update the admin's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Retrieve the authenticated admin
        $user = auth('admin')->user();

        // Validate the profile update form data
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|confirmed|min:6'
        ]);

        // Hash the password if provided
        if ($formFields['password'] != NUll) {
            $formFields['password'] = bcrypt(($formFields['password']));
        } else {
            // Remove password from formFields if it's empty
            unset($formFields['password']);
        }

        // Update the admin's profile
        $user->update($formFields);

        // Redirect back with a success message
        return redirect('/admin/dashboard')->with('message', 'Your profile has been updated!');
    }

    /**
     * Remove a user from the system.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeUser(User $user)
    {
        // Send a removal notification email to the user
        Mail::to($user->email)->send(new RemoveMail($user->name));

        // Delete the user
        $user->delete();

        // Redirect back with a success message
        return redirect('/admin/dashboard')->with('message', 'User has been deleted!');
    }

    /**
     * Remove a group from the system.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeGroup(Group $group)
    {
        // Send a removal notification email to the group leader
        Mail::to($group->leader->email)->send(new RemoveGroupMail($group->leader->name, $group->title));

        // Delete the group
        $group->delete();

        // Redirect back with a success message
        return redirect('/admin/dashboard')->with('message', 'Group has been deleted!');
    }
}
