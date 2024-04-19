<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //
    public function main()
    {
        return view('groups', [
            'groups' => Group::all()
        ]);
        // $groups = Group::with('leader')->get();
        // return view('groups', compact('groups'));
    }
    public function create(Request $request)
    {
        dd($request);
    }
}
