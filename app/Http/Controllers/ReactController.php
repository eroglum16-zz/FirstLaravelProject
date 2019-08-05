<?php

namespace App\Http\Controllers;

use App\Album;
use App\Message;
use Illuminate\Http\Request;

class ReactController extends Controller
{
    public function index(){

        $my_id = auth()->id();

        $messages =  Message::where('sender_id',$my_id)
            ->orWhere('receiver_id',$my_id)
            ->with(['sender','receiver'])
            ->get();

        $album = Album::all()->first();

        return view('react.index',compact('messages'));
    }

    public function serveAlbum($id){
        $album = Album::find($id);

        return $album;
    }
}
