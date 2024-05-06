<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index(Group $group)
    {
        // get the user task in the current group
        $tasks = auth()->user()->tasks->where('group_id', $group->id);
        // dd($tasks);

        return view('task.index', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'tasks' => $tasks
        ]);
    }
}
