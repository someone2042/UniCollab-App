<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        return view('welcome', [
            'users' => User::count(),
            'groups' => Group::count(),

        ]);
    }
}
