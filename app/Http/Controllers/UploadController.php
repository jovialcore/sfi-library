<?php

namespace App\Http\Controllers;

use  App\Models\files;

use App\Models\category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            // name attribute of files is pics
            $theUploadedFiles = $req->pics;
            //get the id that of the category that came with the form
            $catId = category::where('name', $category)->value('id');
            $user = Auth::user()->id;
            //note that i could have used  category::where('name', $category)->pluck('id'); but pluck returns an array [1] instead...so the best soltuion according to SO, is value


                //function to check for the fize
                function format_bytes($bytes, $precision = 2) {
                    $units = array('B', 'KB', 'MB', 'GB');

                    $bytes = max($bytes, 0);
                    $pow = floor(($bytes ? log($bytes) : 0) / log(1000));
                    $pow = min($pow, count($units) - 1);

                    $bytes /= pow(1000, $pow);

                    return round($bytes, $precision) . ' ' . $units[$pow];
                }

            foreach($theUploadedFiles as $files) {

            $fileName =  $files->getClientOriginalName();
            $fileExtension= $files->getClientOriginalExtension();
            $fileSize = format_bytes($files->getSize(), 2);
            $filePath= $files->storeAs('uploads', $fileName, 'public');

            // $fileUploadModel->name = $fileName;
            // $fileUploadModel->path = '/storage/'. $filePath;
            // $fileUploadModel->category_id = $catId;
            // $fileUploadModel->file_type = $fileExtension;
            // $fileUploadModel->size = $fileSize;
            // $fileUploadModel->save();

            $fileUploadModel->create([
                'name' => $fileName,
                'path' => '/storage/'. $filePath,
                'size' => $fileSize,
                'file_type' => $fileExtension,
                'category_id' => $catId,
                'size' =>  $fileSize,
                'user_id' => $user
            ]);
        }
            return response()->json(['success' => 'File was successfully uploaded'], 200);



    }

    }
}
