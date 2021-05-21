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

    //the functtion to add catgoery
    public function addCategory(Request $req)
    {

        $req->validate([
            'name' => 'required|string|min:1|max:100',
            'name' => 'unique:categories,name'
        ]);
            $userId  = Auth::user()->id;
        if($req->has('name')) {
                $catModel = new category();
                $catModel->name = $req->name;
                $catModel->user_id = $userId;
                $catModel->save();

        return response()->json(['success' => 'Category was succesffuly saved'], 201);

        }
    }

    public function storeFile(Request $req)
    {


        if ($req->hasFile('pic')) {

        $req->validate([
            'pic.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|required|max:2048'
        ]);

            //lets decode the cats attribute from the formdata in our vuejs
            $category = json_decode($req->cats);
            // name attribute of files is pic
            $theUploadedFiles = $req->pic;
        $noOfFilesUploaded = count($theUploadedFiles);
            //get the id that of the category that came with the form
            $catId = category::where('name', $category)->value('id');
            $user = Auth::user()->id;
            //note that i could have used  category::where('name', $category)->pluck('id'); but pluck returns an array [1] instead...so the best soltuion according to SO, is value


            //function to check for the file fize and store in database
            function format_bytes($bytes, $precision = 2)
            {
                $units = array('B', 'KB', 'MB', 'GB');

                $bytes = max($bytes, 0);
                $pow = floor(($bytes ? log($bytes) : 0) / log(1000));
                $pow = min($pow, count($units) - 1);

                $bytes /= pow(1000, $pow);

                return round($bytes, $precision) . ' ' . $units[$pow];
            }
            $fileUploadModel = new files;

            foreach ($theUploadedFiles as $files) {

                $fileName =  $files->getClientOriginalName();
                $fileExtension = $files->getClientOriginalExtension();
                $fileSize = format_bytes($files->getSize(), 2);
                $filePath = $files->storeAs('uploads', $fileName, 'public');

                $fileUploadModel->create([
                    'name' => $fileName,
                    'path' => '/storage/' . $filePath,
                    'size' => $fileSize,
                    'file_type' => $fileExtension,
                    'category_id' => $catId,
                    'size' =>  $fileSize,
                    'user_id' => $user
                ]);

            }
            //here we are fetching the latest id from the database using the number of incoming request as a counter which when we are done, we send the details to our frontend
           $ids =  $fileUploadModel->latest()->take($noOfFilesUploaded)->pluck('id');
              return response()->json(['success' => 'File was successfully uploaded', 'ids' =>  $ids ], 201);

        }
    }
}
