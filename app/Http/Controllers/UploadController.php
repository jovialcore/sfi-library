<?php

namespace App\Http\Controllers;

use App\Models\files;

use App\Models\category;

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
            //lets decode the cats attribute from the formdata in our vuejs
            $category = json_decode($req->cats);
            // name attribute fof files is pics
            $theUploadedFiles = $req->pics;

            //get the id that of the category that came with the form

            $catId = category::where('name', $category)->value('id');

            //note that i could have used  category::where('name', $category)->pluck('id'); but pluck returns an array [1] instead...so the best soltuion according to SO, is value

            foreach($theUploadedFiles as $files) {

        // dd($files->getClientMimeType());

            $fileName =  $files->getClientOriginalName();

            $filePath = $files->storeAs('uploads', $fileName, 'public');

            $fileUploadModel->name = $fileName;
            $fileUploadModel->path = '/storage/'. $filePath;
            $fileUploadModel->category_id = $catId;
            $fileUploadModel->save();

            return response()->json(['success' => 'File was successfully uploaded'], 200);
        }
    }

    }
}
