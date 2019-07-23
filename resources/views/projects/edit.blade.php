@extends('layout')

@section('title')
Edit project: {{$project->title}}
@endsection

@section('content')

    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                <li class="breadcrumb-item"><a href="/projects/{{$project->id}}">{{$project->title}}</a></li>
            </ol>
        </nav>

        <h2 class="page-heading">Edit Project
            <form style="display: inline" method="POST" action="/projects/{{$project->id}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-dark pull-right"><i class="fa fa-trash"></i> Delete Project</button>
            </form>
        </h2>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <form class="form" method="POST" action="/projects/{{$project->id}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">

                        <label for="title" >Title</label>
                        <input class="form-control form-control-lg" type="text" name="title" id="title" value="{{$project->title}}">

                    </div>

                    <div class="form-group">

                        <label for="description" >Description</label>
                        <textarea class="form-control form-control-lg" name="description" id="description" rows="5" >{{$project->description}}</textarea>

                    </div>

                    <button type="submit" class="btn btn-dark btn-lg">Save</button>

                </form>
            </div>
        </div>

        @include('errors')


    </div>

@endsection