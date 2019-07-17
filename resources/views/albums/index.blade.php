@extends('layout')

@section('title','Albums')

@section('content')
    <div class="container">
        <h2>Albums</h2>
        <hr>

        <div class="row" style="height: 50%; overflow: scroll;">
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

        <div class="row">
            <div class="col-md-2">
                <button onclick="toggleOn();" class="btn btn-dark btn-lg"><i class="fa fa-plus"></i> New Album</button>
            </div>


            <div class="col-md-10" id="formArea" style="display: none">
                <form class="form" method="POST" action="/albums">
                    {{csrf_field()}}
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input class="form-control form-control-lg" name="artist" placeholder="Artist">
                    </div>
                    <div class="col-md-4 form-group">
                        <input class="form-control form-control-lg" name="title" placeholder="Album Title">
                    </div>
                    <div class="col-md-2 form-group">
                        <button class="btn btn-success btn-lg btn-block" type="submit"> <i class="fa fa-check"></i> Save</button>
                    </div>
                    <div class="col-md-2 form-group">
                        <button class="btn btn-danger btn-lg btn-block" type="submit" onclick="toggleOff();"> <i class="fa fa-times"></i> Close</button>
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