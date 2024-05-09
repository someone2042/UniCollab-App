<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\File;
use App\Models\Task;
use App\Models\Group;
use App\Models\Taskfile;
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
            'deadline' => 'required|date|after:now + 1 hour',
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

    public function respond(Request $request, Group $group, Task $task)
    {
        // dd($request->all());

        if ($task->user_id != auth()->user()->id) {
            return redirect('/group/' . $group->id . '/task/')->with('error', 'You are not allowed to submit this task!');
        }

        if ($task->status != 'assigned') {
            return redirect('/group/' . $group->id . '/task/')->with('error', 'You are no longer allowed to submit this task!');
        }

        $formFields = $request->validate([
            'response_title' => 'required|min:3|max:255',
            'response_description' => 'required|min:3',
        ]);
        $formFields['response_date'] = Carbon::now();

        $formFields['status'] = 'submitted';
        // dd($formFields);
        $task->update($formFields);


        $files = $request->file('response_files');

        // dd($files);

        if ($request->hasFile('response_files')) {
            foreach ($files as $file) {
                // dump($file);
                $fileForm['task_id'] = $task->id;
                $fileForm['name'] = $file->getClientOriginalName();

                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $fileForm['path'] = $file->storeAs('files', $fileName, 'public');

                $fileForm['size'] = $file->getSize() / 1000;
                $fileForm['type'] = $file->getClientOriginalExtension();
                // dd($fileForm);
                Taskfile::create($fileForm);
            }
        }
        return redirect('/group/' . $group->id . '/task/')->with('message', 'Task submitted successfully!');
    }

    public function answer(Request $request, Group $group, Task $task)
    {
        // dd($request->all());
        $formFields = $request->validate([
            'Feedback_Message' => 'required|min:3',
        ]);
        if ($request->res == "Accept") {
            $task->status = 'accepted';
            $task->Feedback_Message = $formFields['Feedback_Message'];
            $task->save();
            foreach ($task->files as $formfile) {

                $originalFilename = $formfile->name;
                // dd($originalFilename);

                $exists = File::where('title', $originalFilename)->exists();
                // dd($exists);
                // if the file exist we will add a new version to the file
                if ($exists) {
                    $file = File::where('title', $originalFilename)->first();

                    $formversion['path'] = $formfile->path;

                    // $formversion['path'] = $request->file('file')->store('files', 'public');
                    $formversion['file_id'] = $file->id;
                    $formversion['version'] = $file->currentVersion()->version + 0.1;
                    $formversion['size'] = $formfile->size;
                    $version = $file->versions()->create($formversion);
                }
                // if the file does not exist we will create a new file
                else {
                    // we creat the file first
                    $form['title'] = $formfile->name;
                    $form['type'] = $formfile->type;
                    $form['group_id'] = $group->id;
                    $file = $group->files()->create($form);

                    // we creat it first version by default it's 1.0
                    $formversion['path'] = $formfile->path;

                    // $formversion['path'] = $request->file('file')->store('files', 'public');
                    $formversion['file_id'] = $file->id;
                    $formversion['version'] = 1;
                    $formversion['size'] = $formfile->size;
                    $version = $file->versions()->create($formversion);
                }
            }
            return redirect()->back()->with('message', 'File uploaded successfully');
        } else {
            $task->status = 'rejected';
            $task->save();
            return redirect()->back()->with('info', 'Task rejected successfully');
        }
    }
}
