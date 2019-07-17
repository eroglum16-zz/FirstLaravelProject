@extends('layout')

@section('title','Albums')

@section('content')
    <div class="container">
        <h2>Albums</h2>
        <hr>

        <table class="table table-dark table-striped">
            <thead>
            <th scope="col">#</th>
            <th scope="col">Artist</th>
            <th scope="col">Title</th>
            </thead>
            <tbody>
            @foreach($albums as $album)
                <tr>
                    <td class="text-center">
                        {{$album->id}}
                    </td>
                    <td class="text-center">
                        {{$album->artist}}
                    </td>
                    <td class="text-center">
                        {{$album->title}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection