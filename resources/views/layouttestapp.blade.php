@extends('layouttest.apptest')

    @section('content')

        <h1>content page</h1>

        @if($people)
        <ul>
            @foreach($people as $person)

            <li>{{$person}}</li>

            @endforeach
        </ul>
        @endif
    

    @stop


    @section('footer')

        <script>alert('hello visitor')</script>

    @stop

