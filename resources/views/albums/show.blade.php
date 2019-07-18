@extends('layout')

@section('title','View Album')

@section('content')
    <div class="container">
        <h2 class="page-heading">{{$album->title}}</h2>
        <hr>

        <div class="row" style="margin-bottom: 20px">

            <button type="button" class="btn btn-outline-primary">ID: </button>

            <div style="display: inline; margin-left: 30px; padding-top: 0.5em ">
                <span  class="align-middle" style="font-family: 'Courier New'; ">{{$album->id}}</span>
            </div>

        </div>

        <div class="row" style="margin-bottom: 20px">

            <button type="button" class="btn btn-outline-primary">Artist: </button>

            <div style="display: inline; margin-left: 30px; padding-top: 0.5em ">
                <span  class="align-middle" style="font-family: 'Courier New'; ">{{$album->artist}}</span>
            </div>

        </div>

        <div class="row">

            <form class="form" method="GET" action="/albums/{{ $album->id }}/edit">
            @csrf
                <button type="submit" class="btn btn-outline-success">Edit</button>
            </form>

        </div>



    </div>
@endsection
