<?php
/** @var \App\Models\Post $post */
?>

@extends('posts.template')
@section('title', 'Posts')

@section('content')
    <h1>Edit post: {{$post->title}}</h1>

    <!-- if there are creation errors, they will show here -->
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{$post->content}}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" name="image">
            <img src="{{$post->thumbnail}}" alt="{{$post->title}}" width="100" height="100">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
