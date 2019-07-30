@extends('layout')

@section('title','React Playground')
@section('active_react','active')

@section('content')

    <div class="container">
        <h2 class="page-heading">React Playground</h2>
        <hr>

        <div id="like_button_container"></div>

    </div>

    <script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>

    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>

    <!-- Load our React component. -->
    <script type="text/babel" src="{{asset('js/ReactApp.js')}}">
    </script>

    <script type="text/babel">
        let domContainer = document.querySelector('#like_button_container');
        ReactDOM.render(<ChatBox  />, domContainer);
    </script>

@endsection