<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Groupmessage;
use Illuminate\Http\Request;
use App\Events\NewChatMessage;
use Illuminate\Support\Facades\Redirect;

class GroupmessageController extends Controller
{
    //
    public function index(Group $group)
    {
        return view('messages.public', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'messages' => $group->groupmessages
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

        broadcast(new NewChatMessage($formFields['content'],  $formFields['group_id']));
        Groupmessage::create($formFields);
        return response()->json(['success' => true]);


        // return Redirect::back();

    }

    public function recive(Request $request)
    {
        return view('receive', ['message' => $request->get('message')]);
    }
}
