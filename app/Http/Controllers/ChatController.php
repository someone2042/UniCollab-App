<?php

namespace App\Http\Controllers;

use App\Events\NewChat;
use App\Models\User;
use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (auth()->user()->id == $group->leader_id) {
            $taskscount = $group->tasks->where('status', 'submitted')->count();
        } else {
            $taskscount = auth()->user()->tasks->where('group_id', $group->id)->where('status', 'assigned')->count();
        }
        return view('messages.private', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'messages' => $messages,
            'user' => $user,
            'taskcount' => $taskscount
        ]);
    }

    public function send(Request $request, Group $group, User $user)
    {
        try {
            $formFields['content'] = $request->content;
            $formFields['receiver_id'] = $user->id;
            $formFields['sender_id'] = auth()->user()->id;

            broadcast(new NewChat($formFields['content'],  $formFields['sender_id'], $formFields['receiver_id']));
            Message::create($formFields);
            return response()->json(['success' => true]);
            //code...
        } catch (\Throwable $th) {
            return response()->json(['error' => $th, 'formFields' => $formFields]);
        }


        // return Redirect::back();

    }
}
