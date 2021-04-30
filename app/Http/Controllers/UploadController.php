<?php

namespace App\Http\Controllers;

use app\Models\files;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }



    public function storeFile (Request $req){


        $validator = $req->validate([
        'pics' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        if( $validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }

        $fileUpload = new files;

        $theUploadedFiles = $req->pics;

        foreach($theUploadedFiles as $files) {
            $fileName = '/uploads/'.$files->getClientOriginalName();

            $filePath = $files->storeAs('uploads', $fileName, 'public');

            $fileUpload->name = $fileName;
            $fileUpload->path = '/storage/'. $filePath;
            $fileUpload->save();
            
            
        }

    return response()->json(['success' => 'File was successfully uploaded', ]);

    }
}
