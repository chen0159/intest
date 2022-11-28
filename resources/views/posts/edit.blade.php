@extends('layouttest.apptest')

    @section('content')

        <h1>edit post</h1>
        <form method="post" action="/postsForm/{{$post->id}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">

            <input type="text" name="title123" placeholder="Enter title" value="{{$post->title123}}">

            <input type="submit" name="submit">
        </form>

        <form method="post" action="/postsForm/{{$post->id}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE">

            <input type="submit" value="DELETE">

        </form>
        
        
    

    @stop