<?php
/** @var \App\Models\Post $post */
?>

@extends('posts.template')
@section('title', 'Posts')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <a href="{{ route('posts.index') }}">< Go back to List</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center">
                <img width="1000" height="500" src="{{ $post->getFirstMediaUrl() }}" alt="{{ $post->title }}">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <b>
                    <a href="{{route('posts.show', $post)}}">
                        {{ $post->title }}
                    </a>
                </b>
            </div>
            <div class="col-12">
                <small><i>Posted at: {{ $post->created_at }}</i></small>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                {{ $post->content }}
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-1">
                @can('update', $post)
                    <a class="btn btn-primary" href="{{ route('posts.edit', $post) }}">Edit</a>
                @endcan
            </div>
            <div class="col-1">
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection
