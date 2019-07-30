<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class ReactController extends Controller
{
    public function index(){


        $data['name']="Mert";
        $data['city']="izmir";
        $data['age']=24;



        return view('react.index',['data'=>$data]);
    }
}
