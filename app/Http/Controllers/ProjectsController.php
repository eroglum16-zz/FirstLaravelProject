<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    //
    public function index(){

        $projects = Project::all();

        $data['projects'] = $projects;

        return view('projects.index',$data);
    }
}
