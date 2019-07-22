@extends('layout')

@section('title','Projects')

@section('content')
    <div class="container">
        <h2 class="page-heading">Projects</h2>
        <hr>


        <table class="table table-dark table-striped">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>

            </thead>
            <tbody>
                @foreach($projects as $project)

                        <tr>


                            <td class="text-center">
                                {{$project->id}}
                            </td>

                            <td class="text-center">
                                <a style="color: inherit" href="/projects/{{$project->id}}"> {{$project->title}} </a>
                            </td>

                            <td class="text-center">
                                {{$project->description}}
                            </td>

                        </tr>

                @endforeach
            </tbody>
        </table>
        <div>

        </div>
    </div>
@endsection