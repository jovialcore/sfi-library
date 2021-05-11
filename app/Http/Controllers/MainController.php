<?php

namespace App\Http\Controllers;

use App\Models\files;

use App\Models\category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MainController extends Controller
{
    public function mainAllImages()
    {
        $allImages = files::paginate(8);

        return view('home', compact('allImages'));
    }

    //show all pictures

    public function showPicture($id) {

        $pic = files::find($id);

        return view('page', compact('pic'));
    }

    //show all catgories

    public function showCategory($id) {

        $category = category::with('files')->find($id);
        dd($category->files);
        return  view ('category', compact('category'));
    }

    //download files

    public function download($id ) {

        $file = files::first($id);

        $filePath = Storage::disk('public')->path('uploads/'.$file->name);
        dd($filePath);
        return response()->download($filePath);

    }

}
