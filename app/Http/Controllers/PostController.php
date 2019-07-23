<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
                                    
    }
    public function index(){

        //$postsByViews = Post::orderby('views', 'desc')->get();
        
       // $posts = Post::all();  //kad je funkcija all ne treba ->get(); za sve ostale treba!!!
        $posts = Post::latest()->get() ;   //ovo sortira postove od najnovijeg
       // $posts = Post::get()->sortByDesc('views'); //ovo sortira po views iliti popularity
        return view('posts.index', compact('posts'));
       // return view('posts.index', compact('posts', 'postsByViews'));
    }

    public function index2(){
        
        // $posts = Post::all();  //kad je funkcija all ne treba ->get(); za sve ostale treba!!!
         //$posts = Post::latest()->get() ;   //ovo sortira postove od najnovijeg
         $posts = Post::get()->sortByDesc('views'); //ovo sortira po views iliti popularity
         return view('posts.index', compact('posts'));
        }

    public function show(Post $post){
        //dd(session()->all());
      /*MOJ NAČIN ZA DZ:
        $key = 'posts/'.$post->slug;
        if (!\Session::has($key)) {

        \DB::table('posts')
           ->where('slug', $post->slug)
           ->increment('views', 1);
         \Session::put($key, 1);
       }*/

       $viewed = session()->get('viewed_posts', []);
       
       

       if (!in_array($post->id, $viewed)) {
           session()->push('viewed_posts', $post->id);
           $post->increment('views');
           $post->save();
       }
      // dd(session()->get('viewed_posts'));
       /* OVAJ NAČIN nijedobar jer na refresh zbraja views
       $views = $post->views;
       $post->views = ++$views;
       $post->save();*/

        return view('posts.show', compact('post'));


    }

    public function create(){
          return view('posts.create');
    }

    public function store(){
        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id(),
            // 'slug' => str_replace(' ', '-', strtolower(request('title')))
            // Koristimo sluggable plugin umjesto gornje naredbe  \app\Post.php
            // https://github.com/cviebrock/eloquent-sluggable
            // $ composer require cviebrock/eloquent-sluggable:^4.8


        ]);

        return redirect()->route('posts.index')->withFlashMessage('Objava je dodana uspješno');
  }
  
 

  public function edit(Post $post)
  {
      //$post = Post::find($id);
      return view('posts.edit', compact('post'));
  }
  
  public function update(Request $request, Post $post)
  {
              //dd($request);
              $request->validate([
                  'title' => 'required|string|max:255',
                  'body' => 'required|min:3|max:65535'.$post->id
               


              ]);
            
              
              $post->title = $request['title'];
              $post->body = $request['body'];
              //$post->user_id = auth()->id();
              $post->slug = null;   //ovako kreira novi slug jer je možda promijenjen title
              $post->save();

              return redirect()->route('posts.index')->withFlashMessage("$post->title uspješno je ažuriran.");
  }

  public function destroy($id)
  {
      $post = Post::find($id);
      $post->delete();

      // \Mail::to($user)->send(new Welcome($user));

      return redirect()->route('posts.index')->withFlashMessage("Post $post->title obrisan je uspješno.");
  }

 



}