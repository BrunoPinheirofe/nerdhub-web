<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $news = News::limit(4)->get();
        
        return view("home", compact("news"));
    }
}
