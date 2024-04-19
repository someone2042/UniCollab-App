<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            'title' => ['required', 'min:3'],
            'company' => ['required', 'min:3'],
            'type' => 'required',
            'description' => 'required'
        ]);

        $formFields['leader_id'] = auth()->id();

        Group::create($formFields);

        return redirect('/groups')->with('message', 'your group created successfully');
    }
}
