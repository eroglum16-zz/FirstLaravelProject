<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CensorSwearwords;
use App\Message;
use Psy\Util\Json;
use Illuminate\Http\Request;

class ReactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['setMessages','getMessages']);
    }

    public function index(){

        $my_id = auth()->id();

        $messages =  Message::where('sender_id',$my_id)
            ->orWhere('receiver_id',$my_id)
            ->with(['sender','receiver'])
            ->get();

        return view('react.index',compact('messages'));
    }

    public function getMessages(){
        $my_id = auth()->id();

        $messages =  Message::where('sender_id',$my_id)
            ->orWhere('receiver_id',$my_id)
            ->with(['sender','receiver'])
            ->get();

        return $messages;
    }

    public function setMessages(){

        $validated = request()->validate([
            'sender_id' => ['required'],
            'receiver_id' => ['required'],
            'messageText' => ['required']
        ]);

        Message::create($validated);

        $my_id = auth()->id();

        $messages =  Message::where('sender_id',$my_id)
            ->orWhere('receiver_id',$my_id)
            ->with(['sender','receiver'])
            ->get();

        return $messages;
    }
}
