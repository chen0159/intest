@extends('layouttest.apptest')

    @section('content')

        <h2>
            {{$post->title123}}
        </h2>
        <button><a href="{{route('postsForm.edit', $post->id)}}">EDIT</a></button>
        <button><a href="{{route('postsForm.index')}}">BACK</a></button>

        

        
    

    @stop