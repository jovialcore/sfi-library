<?php

namespace App\Http\Controllers;

use App\Models\files;

use App\Models\category;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function mainAllImages()
    {
        $allImages = files::paginate(8);
        //fetch all categories
        $cats = category::all();

        return view('home', compact('allImages', 'cats'));
    }
}
