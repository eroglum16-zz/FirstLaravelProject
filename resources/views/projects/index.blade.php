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
                <th scope="col"></th>
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
                                {{strlen($project->description)>80 ? substr($project->description,0,80)." ..." : $project->description}}
                            </td>

                            <td class="text-center">
                                <a href="/projects/{{$project->id}}/edit" style="color: inherit; "> <i class="fa fa-pencil"></i> Edit</a>
                            </td>

                        </tr>

                @endforeach
            </tbody>
        </table>

        <hr>

        <form class="form" method="GET" action="/projects/create">
            <button onclick="toggleOn();" class="btn btn-dark btn-lg"><i class="fa fa-plus"></i> New Project</button>
        </form>
    </div>



@endsection

