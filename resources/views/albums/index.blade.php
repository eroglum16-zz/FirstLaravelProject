@extends('layout')

@section('title','Albums')

@section('content')
    <div class="container">
        <h2 class="page-heading">Albums</h2>
        <hr>

        @if(session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
        @endif

        <div class="row shadow shadow-lg" style="height: 50%; overflow: scroll;">
            <table class="table table-dark table-striped">
                <thead>
                <th scope="col">#</th>
                <th scope="col">Artist</th>
                <th scope="col">Title</th>

                </thead>
                <tbody>
                @foreach($albums as $album)

                    <tr>
                        <td class="text-center align-middle">
                            {{$album->id}}
                        </td>
                        <td class="text-center align-middle">
                            {{$album->artist}}
                        </td>
                        <td class="text-center align-middle">
                            {{$album->title}}
                        </td>
                        <td width="18%">
                            <a class="btn btn-dark" href="/albums/{{$album->id}}/edit" ><i class="fa fa-pencil"></i> Edit</a>
                            <a class="btn btn-dark" href="/albums/{{$album->id}}" ><i class="fa fa-eye"></i> View</a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
        @include('errors')
        <hr>
        <div class="row">
            <div class="col-md-2">
                <button onclick="toggleOn();" class="btn btn-dark btn-lg"><i class="fa fa-plus"></i> New Album</button>
            </div>


            <div class="col-md-10" id="formArea" style="display: {{$errors->any() ? 'block' : 'none'}}">
                <form class="form" method="POST" action="/albums">
                    @csrf
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input class="form-control form-control-lg {{$errors->has('artist') ? 'border-danger' : 'stylized-input'}}" value="{{old('artist')}}"
                               name="artist" placeholder="Artist" onfocus="this.placeholder='Ex: Michael Jackson'" onfocusout="this.placeholder='Artist'" >
                    </div>
                    <div class="col-md-4 form-group">
                        <input class="form-control form-control-lg {{$errors->has('title') ? 'border-danger' : 'stylized-input'}}" value="{{old('title')}}"
                               name="title" placeholder="Album Title" onfocus="this.placeholder='Ex: Thriller'" onfocusout="this.placeholder='Title'">
                    </div>
                    <div class="col-md-2 form-group">
                        <button class="btn btn-success btn-lg btn-block" type="submit"> <i class="fa fa-check"></i> Save</button>
                    </div>
                    <div class="col-md-2 form-group">
                        <button class="btn btn-danger btn-lg btn-block" type="button" onclick="toggleOff();"> <i class="fa fa-times"></i> Close</button>
                    </div>

                </div>
                </form>
            </div>

        </div>

    </div>
@endsection

<script>
    var hidden = true;
    function toggleOn() {
        if (hidden){
            this.document.getElementById("formArea").style.display = "block";
            hidden=false;
        }
    }
    function toggleOff() {
        if (!hidden) {
            this.document.getElementById("formArea").style.display = "none";
            hidden=true;
        }
    }
</script>