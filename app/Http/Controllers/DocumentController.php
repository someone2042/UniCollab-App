<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Message;
use App\Models\Document;
use Spatie\PdfToImage\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
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
        // dd($group->documents);
        return view('document.index', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'documents' => $group->documents,
            'taskcount' => $taskscount, 'mescount' => $mescount
        ]);
    }

    public function store(Group $group, Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|max:255|min:3',
            'file' => 'required'
        ]);
        $file = $request->file('file');
        // dd($file->getClientOriginalExtension());
        $formFields['file'] = $request->file('file')->store('documents', 'public');
        $formFields['type'] = $file->getClientOriginalExtension();
        $formFields['user_id'] = auth()->user()->id;
        $formFields['group_id'] = $group->id;
        $formFields['size'] = $file->getSize() / 1000;
        $document = $group->documents()->create($formFields);

        if ($file->isValid() && $file->getClientOriginalExtension() == 'pdf') {
            $fileName = uniqid() . '.png';
            $path = "C:/Users/MOHAMED/Desktop/pfe/UniCollab-App/storage/app/public/" . $formFields['file'];
            $pdf = new Pdf($path);
            $imagePath = storage_path('app/public/previews/' . $fileName);
            $pdf->setOutputFormat('jpeg')->saveImage($imagePath, 1);

            $document->update([
                'image' => "previews/$fileName"
            ]);
        }

        if ($file->isValid() && ($file->getClientOriginalExtension() == 'pptx' || $file->getClientOriginalExtension() == 'ppt')) {
            $path = "storage/app/public/" . $formFields['file'];
            $fileName = uniqid() . '.jpg';
            chdir('C:\Users\MOHAMED\Desktop\pfe\UniCollab-App');
            $output = shell_exec("py extract_image.py $path  storage/app/public/previews $fileName");

            $document->update([
                'image' => "previews/$fileName"
            ]);

            // dd($output);

        }
        if ($file->isValid() && ($file->getClientOriginalExtension() == 'doc' || $file->getClientOriginalExtension() == 'docx')) {
            $path = "storage/app/public/" . $formFields['file'];
            $fileName = uniqid() . '.jpg';
            chdir('C:\Users\MOHAMED\Desktop\pfe\UniCollab-App');
            $output = shell_exec("py extract_doc_image.py $path  $fileName");

            $document->update([
                'image' => "previews/$fileName"
            ]);
        }
        if ($file->isValid() && $file->getClientOriginalExtension() == 'html') { {
                $document->update([
                    'image' => "previews/html.png"
                ]);
            }
        }
        if ($file->isValid() && $file->getClientOriginalExtension() == 'txt') { {
                $document->update([
                    'image' => "previews/txt.png"
                ]);
            }
        }

        if ($file->isValid() && ($file->getClientOriginalExtension() == 'xlsx' || $file->getClientOriginalExtension() == 'csv')) { {
                $document->update([
                    'image' => "previews/excel.png"
                ]);
            }
        }
        if ($file->isValid() && ($file->getClientOriginalExtension() == 'zip' || $file->getClientOriginalExtension() == 'tar')) { {
                $document->update([
                    'image' => "previews/zip.png"
                ]);
            }
        }
        if ($file->isValid() && ($file->getClientOriginalExtension() == 'mp4' || $file->getClientOriginalExtension() == 'mov' || $file->getClientOriginalExtension() == 'avi' || $file->getClientOriginalExtension() == 'wmv')) { {
                $document->update([
                    'image' => "previews/video.png"
                ]);
            }
        }
        if ($file->isValid() && ($file->getClientOriginalExtension() == 'm4a' || $file->getClientOriginalExtension() == 'flac' || $file->getClientOriginalExtension() == 'mp3' || $file->getClientOriginalExtension() == 'wmv')) { {
                $document->update([
                    'image' => "previews/mp3.png"
                ]);
            }
        }
        if ($file->isValid() && ($file->getClientOriginalExtension() == 'png' || $file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'gif' || $file->getClientOriginalExtension() == 'jpeg')) { {
                $document->update([
                    'image' => $formFields['file']
                ]);
            }
        }
        return redirect('/group/' . $group->id . '/documents')->with('message', 'Document added successfully');
    }

    public function delete(Group $group, Document $document, Request $request)
    {
        if (auth()->user()->id == $group->leader_id || auth()->user()->id == $document->user->id) {
            Storage::disk('public')->delete($document->file);
            Storage::disk('public')->delete($document->image);
            $document->delete();
            return redirect("/group/$group->id/documents")->with('message', 'Document deleted successfully');
        } else {
            return redirect("/group/$group->id/documents")->with('error', 'you are not the owner of this document');
        }
    }

    public function show(Group $group, Document $document)
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

        return view('document.show', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'document' => $document,
            'taskcount' => $taskscount,
            'mescount' => $mescount
        ]);
    }
}
