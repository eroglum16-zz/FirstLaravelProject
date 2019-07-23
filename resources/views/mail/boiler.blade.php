@component('mail::message')
# {{$project->title}}

{{$project->description}}

@component('mail::button', ['url' => url('/projects/'.$project->id)])
See Project
@endcomponent

@auth
Thanks {{auth()->user()->name}}
@endauth
@endcomponent
