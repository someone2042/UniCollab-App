<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    //
    public function index(Group $group)
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
        return view('invitation.index', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitations' => $group->invitedBy,
            'taskcount' => $taskscount, 'mescount' => $mescount
        ]);
    }
    public function response(Request $request, Group $group, User $user)
    {
        if ($group->leader_id == auth()->user()->id) {

            if ($request->res == "Accept") {
                $group->members()->syncWithoutDetaching($user->id);
                $group->invitedBy()->detach($user->id);
                return redirect()->route('group-invi', $group)->with('message', 'Invitation accepted successfully!');
            } else {
                $group->invitedBy()->detach($user->id);
                return redirect()->route('group-invi', $group)->with('info', 'Invitation is refused successfully!');
            }
        } else {
            return redirect()->route('group-invi', $group)->with('error', 'You are not the leader of this group');
        }
    }
}
