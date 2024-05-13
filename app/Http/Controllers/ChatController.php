<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //
    public function index(Group $group, User $user)
    {
        $authuserid = auth()->user()->id;
        $userid = $user->id;
        // dd($authuserid, $userid);
        $messages = Message::where('sender_id', $authuserid)
            ->where('receiver_id', $userid)
            ->orWhere(function ($query) use ($authuserid, $userid) {
                $query->where('sender_id', $userid)
                    ->where('receiver_id', $authuserid);
            })->get();
        // dd($messages);

        return view('messages.private', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'messages' => $messages,
            'user' => $user,
        ]);
    }
}
