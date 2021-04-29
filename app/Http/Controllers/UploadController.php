<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }



    public function storeFile (Request $rq){

            $theUploadedFiles = $rq->pics;

            foreach($theUploadedFiles as $files) {
                $files->store('dummy');
            }

           return response(['status'=>'success'],200);

    }
}
