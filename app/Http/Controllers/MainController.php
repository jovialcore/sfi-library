<?php

namespace App\Http\Controllers;

use App\Models\files;

use Illuminate\Http\Request;

class MainController extends Controller
{
        public function mainAllImages() {
            $allImages =files::all();
            return view('home', compact('allImages'));
        }
}
