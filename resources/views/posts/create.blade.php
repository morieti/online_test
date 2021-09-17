@extends('posts.template')
@section('title', 'Posts')

@section('content')
    <h1>Create a post</h1>

    <!-- if there are creation errors, they will show here -->
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection
