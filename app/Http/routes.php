<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Country;
use App\Post;
use App\Role;
use App\User;

Route::get('/', function () {
    return view('welcome');
});



//Route::get('/about', function(){
//    return view('about');
//});



//Route::get('/contact', function (){
//    return view('contact');
//});



//Route::get('/post/{id}/{name}', function($id, $name){
//    //return view('post', array($id));
//     return "Post number  $id $name " ;
//});



//Route::get('/post/{name}/{id}', 'PostsController@index');





//Route::get('/admin/post/example', array('as'=>'admin.post', function(){
//    $url = route('admin.post');
//    return "the '\$admin.post url' = $url ";
//}));


/*
|--------------------------------------------------------------------------
| Application Raw wueries
|--------------------------------------------------------------------------
*/

Route::get('/posts/{id}/{name}/{premission}', 'PostsController@show_post');


Route::get('/contact', 'PostsController@contact');


// Insert data to database
Route::get('/insert', 'PostsController@insertData');



// Read data from database
Route::get('/read/{id}', 'PostsController@readData');



// Update data to database
Route::get('/edit/{id}', 'PostsController@updatePost');



// Update data to database
Route::get('/delete/{id}', 'PostsController@deletePost');






/*
|--------------------------------------------------------------------------
| Application Eloquent
|--------------------------------------------------------------------------
*/

// show all posts
Route::get('/posts', 'PostsController@index');

// Show a specific post
Route::get('/posts/{id}', 'PostsController@show_post');


// find where
Route::get('/findwhere/{id}', function ($id){
    $posts = Post::where('id', $id)->orderBy('id', 'desc')->take(1)->get();
//    print_r($post);
    return $posts;
});



// find more
Route::get('/findmore', function (){
//    $post = Post::findOrFail(4);
    echo '<pre>';
    $posts = Post::where('id', '>', 3)->take(10)->get();
//    print_r($post[0]);
    foreach ($posts as $post) {
        echo $post->title.'<br>';
    }
});



Route::get('/basicinsert', function (){
    $post = new Post;

$post->title   = 'this is Eloquent inset';
$post->content = 'Wow eloquent is awsome and easy';

$post->save();
});



Route::get('/basicinsert2', function (){
    $post = new Post();
    $post->title = 'PHP with OOP';
    $post->content = 'PHP with OOP is the best method for php';
    $post->save();
});



Route::get('/create', function (){
    Post::create(['title'=>'Create title', 'content'=>'i\'m learning a lot with edwin']);
});



Route::get('/update', function (){
Post::where('id',9)->where('is_admin',0)->update(['title'=>'New php title', 'content'=>'I have alittle love on my instructorrrr.']);
});



Route::get('/delete', function (){
    $post = Post::find(9);
    $res = $post->delete();
    return print_r($res);
});



Route::get('delete2', function (){
    Post::destroy([10, 11]);

    //Post::where('is_admin', 0)->delete();
});



Route::get('/softdelete', function (){
    Post::find(14)->delete();
});




Route::get('/readsoftdelete', function (){
//    $post = Post::onlyTrashed()->get();
//    return $post;

    $post = Post::withTrashed()->where('id',14)->get();
    return $post;
});



Route::get('/restore', function (){
    Post::onlyTrashed()->restore();
});



Route::get('forcedelete', function (){
    Post::onlyTrashed()->forceDelete();
});


/*
|--------------------------------------------------------------------------
|  Eloquent Relationships
|--------------------------------------------------------------------------
*/



// One to one relationships (hasOne)
Route::get('/user/{id}/post', function ($id){
//    return User::find($id)->post->title;
    $userpost =  User::find($id)->post;
    $userpost->title = 'PHP with oop NEW';
    $userpost->save();
    return $userpost->title;
});


// invers relationship (belongsTo)
Route::get('/post/{id}/user', function ($id){
    $user_p = Post::find($id)->user;
    return 'Post id 1 belongs to '.$user_p->name;
});



// One to many relationship (hasMany)
Route::get('/user/{id}/posts', function ($id){
    $posts = User::find($id)->posts;
//    return $posts;
    foreach ($posts as $post){
        echo $post->title.'<br>';
    }
});



// Many to many Relationship
Route::get('/user/{id}/roles', function ($id){
    $roles = User::find($id)->roles;
//    return $roles;
    foreach ($roles as $role){
        echo $role->id.' | '.$role->name.'<br>';
    }

//    $user_roles = User::find($id)->roles()->orderBy('id', 'desc')->get();
});



Route::get('/role/{id}/users', function ($id){
//    $role = Role::find($id);
////    return $users;
//    foreach ($role->users as $user){
//        echo $user->id.' | '.$user->name.'<br>';
//    }
    $role_users = Role::find($id)->users()->orderBy('id', 'desc')->get();
//    return $role_users;
    foreach ($role_users as $user){
        echo $user->id.' | '.$user->name.'<br>';
    }

});

// Accessing intermediate table/ pivot
Route::get('/user/{id}/pivot', function ($id){
    $pivot = User::find($id)->roles;
    foreach ($pivot as $role){
        echo $role->pivot.'<br>';
    }
});




Route::get('/country/{id}/posts', function ($id){
    $ctrposts = Country::find($id)->posts;
    foreach ($ctrposts as $post){
        echo $post.'<br>';
    }
});




Route::get('/post/{id}/photos', function ($id){
    $post = Post::find($id);
    foreach ($post->photos as $photo){
        echo $photo.'<br>';
    }
});


Route::get('/user/{id}/photos', function ($id){
    $user = User::find($id);

    foreach ($user->photos as $photo){
        echo $photo;
    }
});


















