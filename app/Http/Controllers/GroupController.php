<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    //
    public function index()
    {
        return view('groups', [
            'groups' => auth()->user()->memberships
        ]);
        // $groups = Group::with('leader')->get();
        // return view('groups', compact('groups'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'company' => ['required', 'min:3'],
            'type' => 'required',
            'description' => 'required'
        ]);

        $formFields['leader_id'] = auth()->id();

        $group = Group::create($formFields);
        $group->members()->attach(auth()->id());

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

    public function update(Request $request, Group $group)
    {
        if (auth()->user()->id == $group->leader_id) {
            $formFields = $request->validate([
                'title' => ['required', 'min:3', 'max:255'],
                'company' => ['nullable', 'min:3'],
                'type' => 'nullable',
                'description' => 'required'
            ]);
            $group->update($formFields);

            return redirect('/home')->with('message', 'your group updated successfully');
        }
        return redirect('/home')->with('error', 'you are not the leader of this group');
    }

    public function join(Request $request)
    {
        $formFields = $request->validate([
            'code' => 'required|size:6|exists:groups,code'
        ]);

        $group = Group::where('code', strtoupper($formFields['code']))
            ->orWhere('code', strtolower($formFields['code']))
            ->first();
        if ($group->type == 'public') {
            $group->members()->syncWithoutDetaching(auth()->user()->id);
            return redirect('/home')->with('message', 'you joined the group successfully!');
        }
        $group->invitedBy()->syncWithoutDetaching(auth()->user()->id);
        return redirect('/home')->with('info', 'Your request to join the group has been sent.');
        // dd($group);
    }

    public function leave(Group $group)
    {
        if ($group->members()->find(auth()->user()->id) == null) {
            return redirect('/home')
                ->with('error', 'you are not a member of this group');
        }
        $group->members()->detach(auth()->user()->id);
        return redirect('/home')->with('message', 'you left the group successfully!');
    }

    public function show(Group $group)
    {
        return view('workspace', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy)
        ]);
    }
}
