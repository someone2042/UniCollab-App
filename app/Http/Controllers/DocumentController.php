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
    /**
     * Display a listing of the documents for a group.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        // Check if the current user is the group leader
        if (auth()->user()->id == $group->leader_id) {
            // Get the number of submitted tasks for the group leader
            $taskscount = $group->tasks->where('status', 'submitted')->count();
        } else {
            // Get the number of assigned tasks for the current user
            $taskscount = auth()->user()->tasks->where('group_id', $group->id)->where('status', 'assigned')->count();
        }

        $userid = auth()->user()->id;

        // Count the number of unseen messages for each member
        $mescount = [];
        foreach ($group->members as $member) {
            $mescount[$member->id] = Message::where('sender_id', $member->id)
                ->where('receiver_id', $userid)->where('seen', false)->count();
        }

        // Return the document index view with the required data
        return view('document.index', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'documents' => $group->documents,
            'taskcount' => $taskscount, 'mescount' => $mescount
        ]);
    }

    /**
     * Store a newly created document in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function store(Group $group, Request $request)
    {
        // Calculate the total size of uploaded files in the group
        $sum = $request->file('file')->getSize() / 1000;
        foreach ($group->documents as $doc) {
            $sum += $doc->size;
        }

        // Check if the total size exceeds the limit
        if ($sum > 102400) {
            return redirect("/group/$group->id/documents")->with('error', 'Group upload limit reached. Total file size cannot be more than 100 MB.');
        }

        // Validate the request data
        $formFields = $request->validate([
            'title' => 'required|max:255|min:3',
            'file' => 'required'
        ]);

        // Store the uploaded file
        $file = $request->file('file');
        $formFields['file'] = $request->file('file')->store('documents', 'public');
        $formFields['type'] = $file->getClientOriginalExtension();
        $formFields['user_id'] = auth()->user()->id;
        $formFields['group_id'] = $group->id;
        $formFields['size'] = $file->getSize() / 1000;

        // Create the document record in the database
        $document = $group->documents()->create($formFields);

        // Generate and store a preview image for PDF files
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

        // Generate and store a preview image for PPT/PPTX files
        if ($file->isValid() && ($file->getClientOriginalExtension() == 'pptx' || $file->getClientOriginalExtension() == 'ppt')) {
            $path = "storage/app/public/" . $formFields['file'];
            $fileName = uniqid() . '.jpg';
            chdir('C:\Users\MOHAMED\Desktop\pfe\UniCollab-App');
            $output = shell_exec("py extract_image.py $path  storage/app/public/previews $fileName");

            $document->update([
                'image' => "previews/$fileName"
            ]);
        }

        // Generate and store a preview image for DOC/DOCX files
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

    /**
     * Remove the specified document from storage.
     *
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Document  $document
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Group $group, Document $document, Request $request)
    {
        // Check if the current user is authorized to delete the document
        if (auth()->user()->id == $group->leader_id || auth()->user()->id == $document->user->id) {
            // Delete the document file and image from storage
            Storage::disk('public')->delete($document->file);
            Storage::disk('public')->delete($document->image);

            // Delete the document record from the database
            $document->delete();

            // Redirect back to the documents page with a success message
            return redirect("/group/$group->id/documents")->with('message', 'Document deleted successfully');
        } else {
            // Redirect back to the documents page with an error message
            return redirect("/group/$group->id/documents")->with('error', 'you are not the owner of this document');
        }
    }

    /**
     * Display the specified document.
     *
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group, Document $document)
    {
        // Check if the current user is the group leader
        if (auth()->user()->id == $group->leader_id) {
            // Get the number of submitted tasks for the group leader
            $taskscount = $group->tasks->where('status', 'submitted')->count();
        } else {
            // Get the number of assigned tasks for the current user
            $taskscount = auth()->user()->tasks->where('group_id', $group->id)->where('status', 'assigned')->count();
        }

        $userid = auth()->user()->id;

        // Count the number of unseen messages for each member
        $mescount = [];
        foreach ($group->members as $member) {
            $mescount[$member->id] = Message::where('sender_id', $member->id)
                ->where('receiver_id', $userid)->where('seen', false)->count();
        }

        // Return the document show view with the required data
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
