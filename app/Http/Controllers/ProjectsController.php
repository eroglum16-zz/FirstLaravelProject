<?php

namespace App\Http\Controllers;


use App\Events\ProjectCreated;
use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

        //$this->middleware('auth')->except(['index']);
    }

    public function index(){

        //$projects = Project::where('owner_id',auth()->id())->get();

        $projects = auth()->user()->projects;

        $data['projects'] = $projects;

        return view('projects.index',$data);
    }

    public function show(Project $project){

        //abort_unless(auth()->user()->owns($project),403);
        //abort_if($project->owner_id !== auth()->id() , 403);

        //abort_if(\Gate::denies('view',$project),403);

        $this->authorize('view', $project);



        return view('projects.show',['project'=>$project]);
    }

    public function create(){
        return view('projects.create');
    }

    public function edit(Project $project){


        return view('projects.edit',compact('project'));
    }

    public function store(){

        $validated = $this->validateProject();

        $validated['owner_id']=auth()->id();

        $project = Project::create($validated);

        event(new ProjectCreated($project));

        return redirect('/projects');
    }

    public function update(Project $project){

        $validated = $this->validateProject();

        $project->update($validated);

        return redirect('/projects');

    }

    public function destroy(Project $project){

        $project->delete();

        return redirect('/projects');
    }

    protected function validateProject(){
        return request()->validate([
            'title' => ['required','min:3','max:255'],
            'description' => ['required','min:20']
        ]);
    }
}
