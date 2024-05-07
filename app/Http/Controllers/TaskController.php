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
        if (auth()->user()->id == $group->leader_id) {
            $tasks = $group->tasks;
        } else {
            $tasks = auth()->user()->tasks->where('group_id', $group->id);
        }
        // dd($tasks);

        return view('task.index', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'tasks' => $tasks
        ]);
    }

    public function create(Group $group)
    {

        return view('task.create', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
        ]);
    }
}
