<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Spatie\PdfToImage\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Alignment;

class DocumentController extends Controller
{
    public function index(Group $group)
    {
        return view('document.index', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy)
        ]);
    }

    public function store(Group $group, Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|max:255|min:6',
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
            $fileName = uniqid() . '.jpg';
            $path = "C:/Users/MOHAMED/Desktop/pfe/UniCollab-App/storage/app/public/" . $formFields['file'];
            $pdf = new Pdf($path);
            $imagePath = storage_path('app/public/previews/' . $fileName);
            $pdf->setOutputFormat('jpeg')->saveImage($imagePath, 1);

            $document->update([
                'image' => $imagePath
            ]);
        }

        if ($file->isValid() && ($file->getClientOriginalExtension() == 'pptx' || $file->isValid() && $file->getClientOriginalExtension() == 'ppt')) {
            $path = "C:/Users/MOHAMED/Desktop/pfe/UniCollab-App/storage/app/public/" . $formFields['file'];
            // $ppt = IOFactory::load($path);
            // require_once 'vendor/autoload.php';
            $presentation  = new PhpPresentation();
            // $oReader = IOFactory::createReader('PowerPoint2007');
            $presentation = IOFactory::load($path);
            dd($presentation);
            // dd($oReader);
            // $ppt = $presentation->load($filePath);

            // $firstSlide = $ppt->getActiveSlide();

            // // Attempt to get an image representation of the first slide
            // $image = $firstSlide->getThumbnail(); // This might not work for all PPTX structures

            // if ($image) {
            //     // Save the image
            //     $imageName = uniqid() . '.jpg';
            //     $image->save(public_path('uploads/images/' . $imageName));
            //     return asset('uploads/images/' . $imageName); // Return the image URL
            // }
        }
        return redirect('/group/' . $group->id . '/documents')->with('message', 'Document added successfully');
    }
}
