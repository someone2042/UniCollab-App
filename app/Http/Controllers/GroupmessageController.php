<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Message;
use App\Models\Groupmessage;
use Illuminate\Http\Request;
use App\Events\NewChatMessage;
use Illuminate\Support\Facades\Redirect;

class GroupmessageController extends Controller
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
        return view('messages.public', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'messages' => $group->groupmessages,
            'taskcount' => $taskscount, 'mescount' => $mescount
        ]);
    }

    public function send(Request $request, Group $group)
    {
        // dd('hello');
        // dd($request->all());
        // $formFields = $request->validate([
        //     'content' => 'required',
        // ]);
        $formFields['content'] = $request->content;
        $formFields['user_id'] = auth()->id();
        $formFields['group_id'] = $group->id;

        broadcast(new NewChatMessage($formFields['content'],  $formFields['group_id'], $formFields['user_id']));
        Groupmessage::create($formFields);
        return response()->json(['success' => true]);


        // return Redirect::back();

    }

    public function recive(Request $request)
    {
        return view('receive', ['message' => $request->get('message')]);
    }
}
