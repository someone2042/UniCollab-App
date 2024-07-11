<?php

namespace App\Http\Controllers;

use App\Events\NewChat; // Import the NewChat event class.
use App\Models\User;
use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display the chat interface for a specific group and user.
     *
     * @param  \App\Models\Group  $group  The group the chat belongs to.
     * @param  \App\Models\User  $user  The user the chat is with.
     * @return \Illuminate\View\View
     */
    public function index(Group $group, User $user)
    {
        $authuserid = auth()->user()->id; // Get the ID of the authenticated user.
        $userid = $user->id;

        // Retrieve messages between the authenticated user and the specified user.
        $messages = Message::where('sender_id', $authuserid)
            ->where('receiver_id', $userid)
            ->orWhere(function ($query) use ($authuserid, $userid) {
                $query->where('sender_id', $userid)
                    ->where('receiver_id', $authuserid);
            })->orderBy('id')->get();

        // Mark messages as seen if they are received by the authenticated user.
        foreach ($messages as $message) {
            if ($message->receiver_id == auth()->user()->id && !$message->seen) {
                $mes = Message::find($message->id);
                $mes->seen = true;
                $mes->save();
            }
        }

        // Calculate the number of tasks for the authenticated user in the group.
        if (auth()->user()->id == $group->leader_id) {
            // If the authenticated user is the group leader, get the count of submitted tasks.
            $taskscount = $group->tasks->where('status', 'submitted')->count();
        } else {
            // Otherwise, get the count of assigned tasks for the user in the group.
            $taskscount = auth()->user()->tasks->where('group_id', $group->id)->where('status', 'assigned')->count();
        }

        $userid = auth()->user()->id;
        $mescount = [];

        // Calculate the number of unseen messages from each group member to the authenticated user.
        foreach ($group->members as $member) {
            $mescount[$member->id] = Message::where('sender_id', $member->id)
                ->where('receiver_id', $userid)->where('seen', false)->count();
        }

        // Return the view for private messages with relevant data.
        return view('messages.private', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'messages' => $messages,
            'user' => $user,
            'taskcount' => $taskscount,
            'mescount' => $mescount
        ]);
    }

    /**
     * Send a message to a user within a group.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request object.
     * @param  \App\Models\Group  $group  The group the message belongs to.
     * @param  \App\Models\User  $user  The recipient of the message.
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request, Group $group, User $user)
    {
        try {
            // Prepare message data.
            $formFields['content'] = $request->content;
            $formFields['receiver_id'] = $user->id;
            $formFields['sender_id'] = auth()->user()->id;

            // Create the message in the database.
            $res = Message::create($formFields);

            // Broadcast the new message event to other users.
            broadcast(new NewChat($formFields['content'],  $formFields['sender_id'], $formFields['receiver_id'], $res->id))->toOthers();

            // Return a success response.
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            // Return an error response if an exception occurs.
            return response()->json(['error' => $th, 'formFields' => $formFields]);
        }
    }

    /**
     * Mark a message as seen.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request object.
     * @return \Illuminate\Http\JsonResponse
     */
    public function seen(Request $request)
    {
        // Find the message by ID.
        $mes = Message::find($request->id);

        // Mark the message as seen.
        $mes->seen = true;
        $mes->save();

        // Return a JSON response with the updated message.
        return response()->json(['request' => $mes]);
    }
}
