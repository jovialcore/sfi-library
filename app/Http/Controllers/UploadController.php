<?php

namespace App\Http\Controllers;

use App\Models\files;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }



    public function storeFile (Request $req){

        $validator = $req->validate([
        'pics' => 'required',
        'pics.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);

        
        $fileUploadModel = new files;
        if($req->hasFile('pics')) {

            $theUploadedFiles = $req->pics;

            foreach($theUploadedFiles as $files) {

        // dd($files->getClientMimeType());

            $fileName = '/uploads/'.$files->getClientOriginalName();

            $filePath = $files->storeAs('uploads', $fileName, 'public');

            $fileUploadModel->name = $fileName;
            $fileUploadModel->path = '/storage/'. $filePath;
            $fileUploadModel->save();
            
            return response()->json(['success' => 'File was successfully uploaded'], 200);
        }
    }
  
    }
}
