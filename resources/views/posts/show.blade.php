@extends('layouts.master')

@section('content')

<div class="blog-post">

    <h2 class="blog-post-title">
        {{ $post->title }}
    </h2>

    <p class="blog-post-meta">
        <!-- https://carbon.nesbot.com/docs/#api-formatting -->
        {{ $post->created_at->toFormattedDateString() }} by<a href="#">{{ $post->user->name }}</a>
    </p>
    
    @if (count($post->tags))
        
    <section class="mb-3">
            <h6 class="d-inline">Tags:</h6>
            @foreach ($post->tags as $tag)
                <a href="" class="badge badge-primary"> {{ $tag->name }} </a>
            @endforeach

    </section>

    @endif
  
    <article class="text-justify">
        {{ $post->body }}
    </article>

</div>

<form action="{{ route('posts.destroy', $post->id)  }}" method="post">
        @method('DELETE')
        @csrf 


        <!--ovaj if sakriva uredi i briši giumbiće za korsinsika koji nije autor-->
        @if($post->user_id === auth()->id())
        <div class="float-right">
            <a href="{{ route('posts.edit', $post->slug)  }}" class="btn btn-info">Uredi</a>
            <button class="btn btn-danger">Obriši</button>
         </div>
         @endif
<a href="{{  route('posts.index') }}" class="btn btn-primary">Natrag</a>
</form>

<br>

<div class="card">
    <div class="card-body">
        <form action="{{  route('comments.store', $post->slug) }}" method="post">
            @csrf

            <div class="form-group">
            <textarea name="body" id="body" cols="30" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Komentiraj</button>
            </div>
        </form>
    </div>
</div>
@if(count($post->comments))
<hr>
<div class="comments">
    <h3>Komentari</h3>
    <ul class="list-group">
        @foreach ($post->comments as $comment)
        <li class="list-group-item">
            <b>{{ $comment->user->name }}</b>
            <i>{{ $comment->created_at->diffForHumans() }}</i>
            <p>{{ $comment->body }}</p>
            
        </li>
        @endforeach
    </ul>
</div>
@else
<br>

<p>Budi prvi koji će komentirati ovaj post</p>
@endif
<br>

@endsection