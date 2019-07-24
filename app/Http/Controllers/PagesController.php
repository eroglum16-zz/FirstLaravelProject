<?php

namespace App\Http\Controllers;

use App\Notifications\AlbumCreated;
use Illuminate\Http\Request;
use App\User;

class PagesController extends Controller
{
    public function home(){

        session(['name'=>'Mert']);

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

    public function markRead($id){

        foreach (auth()->user()->unreadNotifications as $notification){
            if ($notification->data['id']==$id){
                $notification->markAsRead();
                $n = $notification;
            }
        }
        return true;
    }
}
