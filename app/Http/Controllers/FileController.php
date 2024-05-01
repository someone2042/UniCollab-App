<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

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
    //
}
