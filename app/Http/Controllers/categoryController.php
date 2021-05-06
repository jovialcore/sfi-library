<?php

namespace App\Http\Controllers;

use App\Models\category;

use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function allCategory () {

         $allCat = category::orderBy('created_at', DESC)->get();
         return $allCat;
    }



    public function store (Request $req) {
        $newCategory = new category;

        $newCategory->name = $req->cat['name'];

             
    }
}
