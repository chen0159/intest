<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//
use App\Models\Post;

use function Termwind\render;

//

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        //return "test text the number is: ";


        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return "this is create function";
        return view('posts.create');   // view\posts\create.blade.php
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //return $request->all();
        //return $request->title123;


        Post::create($request->all());
        //另個方法
        //$post = new Post;
        //$post->title123 = $request->title;
        //$post->save();


        return redirect('/postsForm');
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //return "this is show method: " . $id;
        

        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //


        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


        $post = Post::findOrFail($id);
        
        $post->update($request->all());
        
        return redirect('/postsForm');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //


        $post = Post::findOrFail($id);
        $post->delete();
        Post::onlyTrashed()->forceDelete();
        return redirect('/postsForm');
    }
}
