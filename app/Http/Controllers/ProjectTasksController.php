<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Task;

class ProjectTasksController extends Controller
{
    public function update(Task $task){

        $task->mark();


        return redirect('/projects/'.$task->project->id);
    }

    public function store(Project $project){

        request()->validate(['body'=>'required']);

        $project->addTask(request('body'));

        return back();

    }
}
