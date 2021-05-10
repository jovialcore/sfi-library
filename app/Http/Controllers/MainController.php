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

    //show all pictures

    public function showPicture($id) {

        $pic = files::find($id);

        return view('page', compact('pic'));
    }

    //show all catgories

    public function showCategory($id) {
        $cats = files::where('category_id', $id)->get();



        $category = category::find($id);
        return  view ('category', compact('category', 'cats'));
    }

}
