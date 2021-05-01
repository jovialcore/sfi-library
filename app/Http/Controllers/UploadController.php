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
        'pics' => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        if( $validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }

        $fileUploadModel = new files;

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
