<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to laravel loquitah';
        return view( 'pages.index', compact('title') ); //se va buscar en la carpeta view y entra en pages/index.blade.php
        //return view('pages.index')->with('title', $title);//same above
    }

    public function services(){
        $data = array (
            'title' => 'Services' ,
            'services' => ['Web design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }

    public function about(){
        return view('pages.about');
    }

}
