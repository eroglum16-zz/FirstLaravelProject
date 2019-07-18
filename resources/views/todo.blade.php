@extends('layout')

@section('title','Todo')

@section('content')

    <div class="container">
        <h2 class="text-dark page-heading">Todo List</h2>
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