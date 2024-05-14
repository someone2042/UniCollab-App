<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Message;
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

        $group->delete();
        return redirect('/home')->with('message', 'your group deleted successfully');
    }

    public function edit(Group $group)
    {
        return view('edit-group', [
            'group' => $group
        ]);
    }

    public function update(Request $request, Group $group)
    {

        $formFields = $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'company' => ['nullable', 'min:3'],
            'type' => 'nullable',
            'description' => 'required'
        ]);
        $group->update($formFields);

        return redirect('/home')->with('message', 'your group updated successfully');
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
        // dd($group);
        // dd(auth()->user()->id != $group->leader_id);
        if (auth()->user()->id == $group->leader_id) {
            return redirect('/home')
                ->with('error', 'The leader can not leave the group');
        }
        $group->members()->detach(auth()->user()->id);
        return redirect('/home')->with('message', 'you left the group successfully!');
    }

    public function show(Group $group)
    {
        if (auth()->user()->id == $group->leader_id) {
            $taskscount = $group->tasks->where('status', 'submitted')->count();
        } else {
            $taskscount = auth()->user()->tasks->where('group_id', $group->id)->where('status', 'assigned')->count();
        }
        $userid = auth()->user()->id;
        $mescount = [];
        foreach ($group->members as $member) {
            $mescount[$member->id] = Message::where('sender_id', $member->id)
                ->where('receiver_id', $userid)->where('seen', false)->count();
        }
        // dd($mescount);
        return view('workspace', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy), 'taskcount' => $taskscount,
            'mescount' => $mescount,
        ]);
    }
    public function kick_out(Group $group, User $user)
    {
        if ($user->id != $group->leader_id) {
            $group->members()->detach($user->id);
            return redirect()->route('group', $group)->with('info', 'User is removed successfully!');
        } else {
            return redirect()->route('group', $group)->with('error', 'how the fuck did you do that');
        }
    }
}
