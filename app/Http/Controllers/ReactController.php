<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class ReactController extends Controller
{
    public function index(){

        $album = Album::all()->first();

        return view('react.index',compact('album'));
    }

    public function serveAlbum($id){
        $album = Album::find($id);

        return $album;
    }
}
