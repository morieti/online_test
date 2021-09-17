@extends('template')

@section('title', 'Login')

@section('content')
    <div class="container">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <form action="{{ route('authenticate') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <button type="submit" class="btn btn-primary">Login</button>

        </form>
    </div>
@endsection
