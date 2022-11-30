@extends('layouttest.apptest')

    @section('content')

        <h1>create post</h1>

        <!-- 18 create -->

        <!-- <form method="post" action="/postsForm">
        
            {{csrf_field()}}
            <input type="text" name="title123" placeholder="Enter title">

            <input type="submit" name="submit">

        </form> -->

        <!-- 18 create -->




        <!-- 19 create -->

        {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\PostsController@store']) !!}
        
            {{csrf_field()}}

            <div class="form-group">
                {!! Form::label('title123', 'Title:') !!} 
                {!! Form::text('title123', null, ['class' => 'from form-control']) !!} 
            </div>

            {!! Form::submit('create Post', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        <!-- 19 create -->




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