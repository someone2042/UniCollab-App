<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    //
    public function index()
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

        return redirect('/home')->with('message', 'your group created successfully');
    }
    public function delete(Request $request)
    {
        $request->validate(['group_id' => 'required|integer|exists:groups,id']);
        $group = Group::find($request->group_id);
        // dd($group);

        if (auth()->user()->id == $group->leader_id) {
            $group->delete();
            return redirect('/home')->with('message', 'your group deleted successfully');
        }
        return redirect('/home')->with('error', 'you are not the leader of this group');
    }

    public function edit(Group $group)
    {
        if (auth()->user()->id == $group->leader_id) {
            return view('edit-group', [
                'group' => $group
            ]);
        }
        return redirect('/home')->with('error', 'you are not the leader of this group');
    }
}
