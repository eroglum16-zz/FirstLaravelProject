@extends('layout')

@section('title','Edit Album')

@section('content')
    <div class="container">
        <h2 class="page-heading">Edit Album
            <form style="display: inline" method="POST" action="/albums/{{$album->id}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-dark pull-right"><i class="fa fa-trash"></i> Delete Album</button>
            </form>
        </h2>
        <hr>

        <div class="row">

            <form class="form" method="POST" action="/albums/{{$album->id}}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="albumTitle">Album Title</label>
                    <input type="text" name="title" class="form-control" id="albumTitle" value="{{$album->title}}">
                </div>
                <div class="form-group">
                    <label for="artist">Artist</label>
                    <input type="text" name="artist" class="form-control" id="artist" value="{{$album->artist}}">
                </div>
                <hr>
                <button type="submit" class="btn btn-success btn-block">Save</button>
            </form>



        </div>

    </div>
@endsection
