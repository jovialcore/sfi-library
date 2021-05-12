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

        return  view ('category', compact('category'));
    }


    // A big Notice: because all categories where spread apart using the view::share , it demands that you maintain all names category maintaiain


    //download files

    public function download($id ) {

        $file = files::find($id);

        $filePath = Storage::disk('public')->path('uploads/'.$file->name);
        return response()->download($filePath);

    }

}
