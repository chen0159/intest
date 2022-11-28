@extends('layouttest.apptest')

    @section('content')

        <ul>
            @foreach ($posts as $post)
                <li>
                    {{$post->title123}} <button><a href="{{route('postsForm.show', $post->id)}}">SHOW</a></button>
                </li>
            @endforeach
        </ul>

        <button><a href="{{route('postsForm.create')}}">CREATE NEW TITLE</a></button>

        
    

    @stop