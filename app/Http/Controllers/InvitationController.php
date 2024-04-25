<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    //
    public function index(Group $group)
    {
        return view('invitation.index', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitations' => $group->invitedBy,
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
