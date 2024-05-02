<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Group;
use Illuminate\Http\Request;

use function Laravel\Prompts\form;

class FileController extends Controller
{

    public function index(Group $group)
    {
        // dd($group->documents);
        return view('file.index', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'files' => $group->files
        ]);
    }

    public function store(Request $request, Group $group)
    {
        $formFields = $request->validate([
            'file' => 'required'
        ]);

        // dd($request);
        $formfile = $request->file('file');
        $originalFilename = $formfile->getClientOriginalName();
        // dd($originalFilename);

        $exists = File::where('title', $originalFilename)->exists();
        // dd($exists);
        // if the file exist we will add a new version to the file
        if ($exists) {
            $file = File::where('title', $originalFilename)->first();

            $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $formversion['path'] = $request->file('file')->storeAs('files', $fileName, 'public');

            // $formversion['path'] = $request->file('file')->store('files', 'public');
            $formversion['file_id'] = $file->id;
            $formversion['version'] = $file->currentVersion()->version + 0.1;
            $formversion['size'] = $formfile->getSize() / 1000;
            $version = $file->versions()->create($formversion);

            return redirect()->back()->with('message', 'File updated successfully');
        }
        // if the file does not exist we will create a new file
        else {
            // we creat the file first
            $form['title'] = $originalFilename;
            $form['type'] = $formfile->getClientOriginalExtension();
            $form['group_id'] = $group->id;
            $file = $group->files()->create($form);

            // we creat it first version by default it's 1.0
            $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $formversion['path'] = $request->file('file')->storeAs('files', $fileName, 'public');

            // $formversion['path'] = $request->file('file')->store('files', 'public');
            $formversion['file_id'] = $file->id;
            $formversion['version'] = 1;
            $formversion['size'] = $formfile->getSize() / 1000;
            $version = $file->versions()->create($formversion);

            return redirect()->back()->with('message', 'File uploaded successfully');
        }
    }

    public function show(Group $group, File $file)
    {
        dd($file);
        return view('file.show', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
        ]);
    }
    //
}
