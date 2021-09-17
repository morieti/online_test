@extends('posts.template')

@section('title', 'Posts')

@section('content')
    <div class="container">
        <div class="row m-3">
            <div class="col-12 m-0 p-0">
                @can('create', \App\Models\Post::class)
                    <a class="btn btn-primary" href="{{ route('posts.create') }}">Create Post</a>
                @endcan
            </div>
        </div>
        @foreach($posts as $post)
            <div class="row border border-info p-2 m-3">
                <div class="col-2 text-center">
                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}">
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-12">
                            <b>
                                <a href="{{route('posts.show', $post)}}">
                                    {{ $post->title }}
                                </a>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <small><i>Posted at: {{ $post->created_at }}</i></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{ $post->summary }}
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>
@endsection
