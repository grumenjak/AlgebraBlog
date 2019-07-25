@extends('layouts.master')

@section('content')

<div>
    <div>
        <h3>Kreiraj novu objavu</h3>
    </div>
    <hr>
    <div>
        <form action="{{ route('posts.store') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="title">Naslov</label>
                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="body">Post</label>
                <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" id="body" name="body"  id="body" cols="80" rows="10">{{ old('body') }}</textarea>
            </div>

            <div class="form-group mb-4">
                <h6>Oznake</h6>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addTag">
                    Dodaj oznaku
                     </button>
                @foreach ($tags as $tag)                    
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" name="tags[]">
                            <label class="custom-control-label" for="tag-{{ $tag->id }}">{{ $tag->name}} </label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <a href="{{  route('posts.index') }}" class="btn btn-warning">Nazad</a>
                <button type="submit" class="btn btn-success float-right">Kreiraj</button>
            </div>

            @include('layouts.errors')
        </form>
    </div>

    @include('tags.modal')

</div>

@endsection