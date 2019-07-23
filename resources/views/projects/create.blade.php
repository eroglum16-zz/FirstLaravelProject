@extends('layout')

@section('title','Create a new Project')

@section('content')

    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create a Project</li>
            </ol>
        </nav>

        <h2 class="page-heading">Create a new Project</h2>
        <hr>

        <div class="row">
            <div class="col-md-4">
                <form class="form" method="POST" action="/projects">
                    @csrf
                    <div class="form-group">

                        <label for="title" >Title</label>
                        <input class="form-control form-control-lg" type="text" name="title" id="title" value="{{old('title')}}">

                    </div>

                    <div class="form-group">

                        <label for="description" >Description</label>
                        <textarea class="form-control form-control-lg" name="description" id="description" rows="5" >{{old('description')}}</textarea>

                    </div>

                    <button type="submit" class="btn btn-dark btn-lg">Save</button>

                </form>
            </div>
        </div>



    </div>

@endsection