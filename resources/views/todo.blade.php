@extends('layout')

@section('title','Todo')

@section('content')

    <div class="container">
        <h1 class="text-dark">Todo List</h1>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group">
                    @foreach($tasks as $task)
                        <li class="list-group-item bg-dark hover-dark">
                            <i class="fa fa-check"> </i>
                            {{$task}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>


    </div>



@endsection