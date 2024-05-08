<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
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

    public function store(Request $request, Group $group)
    {
        // dd(request()->all());
        $members = $group->members->pluck('id')->toArray(); // Get all user IDs
        // dd($members);

        $formFields = $request->validate([
            'subject' => ['required', 'min:3', 'max:255'],
            'deadline' => 'required|date|after:now',
            'member' => 'required|integer|exists:users,id|in:' . implode(',', $members),
            'description' => 'required|min:3'
        ]);
        $formFields['group_id'] = $group->id;

        $formFields['user_id'] = $formFields['member'];
        unset($formFields['member']);

        $formFields['title'] = $formFields['subject'];
        unset($formFields['subject']);

        $deadline = Carbon::parse($formFields['deadline']);
        $formFields['deadline'] = $deadline;

        $formFields['status'] = 'assigned';

        Task::create($formFields);

        // dd($formFields);
        return redirect('/group/' . $group->id . '/task/')->with('message', 'Task created successfully!');
    }

    public function show(Group $group, Task $task)
    {
        if (auth()->user()->tasks->find($task) != null || auth()->user()->id == $group->leader_id) {
            return view('task.show', [
                'task' => $task,
                'groups' => auth()->user()->memberships,
                'mainGroup' => $group,
                'members' => $group->members,
                'invitaion_count' => count($group->invitedBy),
            ]);
            // dd('works fine');
        } else {
            return redirect('/group/' . $group->id . '/task/')->with('error', 'You are not allowed to view this task!');
        }
    }
}
