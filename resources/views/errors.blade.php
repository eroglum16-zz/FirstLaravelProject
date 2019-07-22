@if($errors->any())
    <hr>
@endif
@foreach($errors->all() as $error)

    <div class="alert alert-info">
        {{$error}}
    </div>
@endforeach