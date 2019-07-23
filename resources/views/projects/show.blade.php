@extends('layout')

@section('title','Project')

@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$project->title}}</li>
            </ol>
        </nav>

        <h2 class="page-heading">{{$project->title}}</h2>
        <hr>

        <div class="margin-bottom-30">
            {{$project->description}}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Tasks</h4>
                    </div>

                    <div class="card-body" style="height: 30%; overflow: scroll">
                    @foreach($project->tasks as $task)

                        <form class="form" method="POST" s action="/tasks/{{$task->id}}">
                            @csrf
                            @method('PATCH')
                            <label class="form-check-label {{$task->completed ? 'is-complete':'' }}"  for="completed">
                                <input type="checkbox" {{$task->completed ? 'checked':'' }}  onchange="this.form.submit()" > {{$task->body}}
                            </label>
                        </form>


                    @endforeach
                    </div>
                    <div class="card-footer">
                        @include('errors')
                        <form class="form form-inline" method="POST" action="/projects/{{$project->id}}/tasks">
                            @csrf

                            <input class="form-control" type="text" name="body" placeholder="New task... " style="margin-right: 20px; width: 80%"> <button class="btn btn-info" style="width: 15%">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection