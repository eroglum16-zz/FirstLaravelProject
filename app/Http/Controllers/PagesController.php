<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        return view('main');
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }

    public function todo(){
        $tasks = [
            'Go to the market',
            'Start the project',
            'Find a store'
        ];

        $data['tasks'] = $tasks;

        return view('todo')->with($data);
    }
}
