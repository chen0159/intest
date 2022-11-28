@extends('layouttest.apptest')

    @section('content')

        <h1>create post</h1>

        <form method="post" action="/postsForm">
        
            {{csrf_field()}}
            
            <input type="text" name="title123" placeholder="Enter title">
            <input type="submit" name="submit">
        
        </form>

        
    

    @stop