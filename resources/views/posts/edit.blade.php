@extends('layouttest.apptest')

    @section('content')

        <h1>edit post</h1>
        <!-- 18 update -->

            <!-- <form method="post" action="/postsForm/{{$post->id}}">

            {{csrf_field()}}

            <input type="hidden" name="_method" value="PUT">
            <input type="text" name="title123" placeholder="Enter title" value="{{$post->title123}}">
            <input type="submit" name="submit">

        </form> -->

        <!-- 18 update -->




        <!-- 19 update -->

        {!! Form::open(['method' => 'PATCH', 'action' => ['App\Http\Controllers\PostsController@update', $post->id]]) !!}

            {{csrf_field()}}
        
            <div class="form-group">
                {!! Form::label('title123', 'Title:') !!} 
                {!! Form::text('title123', "$post->title123", ['class' => 'form form-control']) !!}

                {!! Form::submit('UPDATE', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
        
        <!-- 19 update -->




        <!-- 18 delete -->

        <!-- <form method="post" action="/postsForm/{{$post->id}}">

            {{csrf_field()}}

            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="DELETE">

        </form>-->

        <!-- 18 delete -->




        <!-- 19 delete -->

        {!! Form::open(['method' => 'DELETE', 'action' => ['App\Http\Controllers\PostsController@destroy', $post->id]]) !!}

            <div class="form-group">
                {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
            </div>

        {!! Form::close() !!}

        <!-- 19 delete -->
        



        <!-- 顯示錯誤訊息 -->
        @if(count($errors) > 0)

        <div class="alert alert-danger">

            <ul>

                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach

            </ul>

        </div>
        
        @endif

        
    

    @stop