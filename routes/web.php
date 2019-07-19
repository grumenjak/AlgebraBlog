<?php

//ovom naredbom use smo uveli klasu Post iz foldera app
//use App\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//poziva views/welcome.blade.php   blade.php sam nadodaje
 Route::get('/', function () {
    return view('welcome');
    //dohvaćanje preko modela iz foldera app/Post.php
    //$posts = Post::all();-------------  Prebačeno u PostController.php
    
    //https://laravel.com/docs/5.8/queries#raw-methods
    //$posts = DB::table('posts')->get();

   // return $posts ;     -ovo vraća JSON zapis gornjeg $posts

    /*tu su nam array postovi a gore iznad kreiramo iz baze postove    
$posts = [
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel ipsum tincidunt, ultrices elit eu, sagittis leo. Etiam vel ex ultrices nibh sagittis posuere sed sit amet enim. Integer feugiat a tortor quis porttitor. Praesent odio est, venenatis eget dolor eu, aliquam molestie neque. Phasellus suscipit nisi at dictum facilisis. Duis finibus porttitor nunc sit amet volutpat. Duis aliquet vel nisl eu malesuada.',
        'Aliquam tempor consectetur mi nec tempus. Ut tincidunt congue quam sed dictum. In interdum sed mauris fringilla congue. Donec at enim magna. Nullam mollis dolor nec dolor ornare, iaculis imperdiet ex molestie. Nulla eu ultricies arcu, a fringilla turpis. Vivamus tincidunt lacinia massa nec viverra. Nam neque tellus, feugiat non metus in, varius sollicitudin nisi. Fusce a massa nibh. Pellentesque cursus est sed porttitor porta. Sed aliquet lobortis nisl a suscipit. Fusce sodales vehicula augue, vitae dignissim turpis imperdiet a. In sed ipsum id tortor scelerisque ultrices ac non tellus. Vivamus vel eleifend nibh. Cras sed sem sed sapien laoreet euismod. Curabitur euismod imperdiet neque, sed porttitor mauris pellentesque eget.',
        'Curabitur imperdiet eu odio gravida mollis. In cursus, sapien et rutrum porta, magna tortor vehicula massa, vel dapibus tortor diam eget magna. Vestibulum scelerisque justo sed lorem finibus, eu rutrum eros tristique. Proin ut nibh risus. Sed pharetra, est commodo pharetra luctus, dui metus suscipit eros, quis vestibulum lectus nunc eu lectus. Nunc vel est nulla. Cras eget suscipit magna. Integer sapien nunc, tristique a velit in, condimentum elementum nulla. Etiam lacinia urna a mattis cursus. Vestibulum quis massa vel justo aliquam tincidunt in nec massa. Etiam nisi mauris, efficitur pellentesque massa malesuada, laoreet euismod diam. Quisque interdum ornare urna. Sed ornare nulla eu pretium sagittis. Integer dictum nibh at diam lacinia, eu malesuada urna tempus. Ut ornare tortor vel dictum laoreet. Vivamus efficitur lorem vel risus venenatis, vel imperdiet ipsum consectetur.',
        'Suspendisse eu dapibus leo. Nullam bibendum, velit vitae feugiat porttitor, ante mauris cursus ipsum, ullamcorper ultricies mauris sem nec turpis. Integer ullamcorper, magna nec laoreet scelerisque, est risus cursus sem, sit amet congue est metus sit amet massa. Vivamus ut accumsan turpis, eu finibus augue. Nam tempus malesuada massa et placerat. Phasellus eget turpis fringilla, luctus neque ac, sollicitudin nunc. Suspendisse et turpis eleifend, ornare mauris ac, malesuada dolor. Quisque at justo leo.',
        'Cras iaculis turpis sed lacinia faucibus. Pellentesque pharetra mi nisi, a ultrices sapien euismod vitae. Maecenas tortor sapien, commodo ut mauris in, mattis efficitur nisl. Morbi risus nunc, rutrum dapibus posuere id, tristique at lorem. Nam lacinia mauris lacus, et imperdiet tellus pharetra id. Fusce viverra at nisl nec viverra. Vestibulum suscipit eget dui non varius. Praesent at magna vestibulum, ornare dolor ac, porta neque. Nunc sed magna ut nisl sollicitudin porttitor. Nulla convallis egestas est, ac imperdiet mauris sodales eget. Vestibulum pharetra leo quam, vel eleifend eros placerat in. Cras venenatis enim ullamcorper dignissim varius. Sed viverra diam vitae volutpat sodales. Phasellus commodo ultrices lectus, quis lobortis magna suscipit sit amet. Proin interdum sit amet elit eu semper.'

    ];
    */
    //dd($posts);

    //'posts' je varijabla na welcome.blade.php
   //return view('welcome', ['posts' => $posts]);-----------
  
  //ovaj return je za array
  //return view('welcome', compact('posts'));-------------- Prebačeno u PostController.php 
});

// Kreiranje POSTA
Route::get('/posts/create', 'PostController@create')->name('posts.create');

//Dohvaćanje pojedinog posta
Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/{post}', 'PostController@show')->name('posts.show');



// Spremi POST

Route::post('/post', 'PostController@store')->name('posts.store');



// prikaži formu za uređivanje POSTA
Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');

// spremi uređenog POST u bazu
Route::patch('/posts/{post}', 'PostController@update')->name('posts.update');

// obriši Post
Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy');




//  users.show = /users/show
// prikaži sve usere
Route::get('/users', 'UserController@index')->name('users.index');
// prikaži formu za kreiranje usera
Route::get('/users/create', 'UserController@create')->name('users.create');
// spremi usera u bazu
Route::post('/users', 'UserController@store')->name('users.store');
// prikaži formu za uređivanje usera
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
// spremi uređenog usera u bazu
Route::patch('/users/{user}', 'UserController@update')->name('users.update');
// obriši usera
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');
// prikaži jednog usera
Route::get('/users/{user}', 'UserController@show')->name('users.show');

//**************COMMENTS***********************

Route::post('/posts/{post}/comments', 'CommentController@store')->name('comments.store');


    
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');