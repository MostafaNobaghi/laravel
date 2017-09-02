<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
//        return 'Post index working ';
        $posts = Post::all();

        foreach ($posts as $post){
            echo "$post->title | $post->content <br>";
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "this method create POSTS. id:";
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
        return "this is STORE method";
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
        // return "this is SHOW method id:$id";
        return view('post');
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
        return"this is EDIT method id:$id";
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
        return "update method id:$id";
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
        return "this is DELETE method id:$id";
    }



    // Show contact page
    public function contact(){
        $people = ['edwin', 'mosi', 'jax'];
        return view('contact', compact('people'));
    }



    // Show a post page
    public function show_post($id){
//        return view('post')->with('id', $id);
        $post = Post::find($id);
        $title = $post->title;
        $content = $post->content;
        return view('post', compact('id','title', 'content'));
//        echo '<pre>';
//        print_r($post);
    }



    // Insert data to posts table
    public function insertData() {
        DB::insert('INSERT INTO posts (title, content) VALUES(?, ?)',
        ['PHP with oop', 'Object oriented programming  is the best way of programming.']);
//        return $affected;
    }




    // Read data from database
    public function readData($id){
        $result = DB::select("SELECT * FROM posts WHERE ID = ?",[$id]);
        echo '<pre>';
        print_r($result);
        echo $result[0]->title;
    }


    // Update databse record
    public function updatePost($id){
        $updated = DB::update("UPDATE posts SET title=?, content=?, updated_at=? WHERE id=?",
            ['PHP with Laravel 2','Laravel is the best thing that has happened to PHP 2', date('Y/m/d H:i:s'), $id]);
        return $updated;
    }






    // Update databse record
    public function deletePost($id){
        $deleted = DB::delete('DELETE FROM posts WHERE id = ?', [$id]);
        return $deleted;
    }















}
