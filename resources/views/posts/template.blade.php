<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css">
    <title>@yield('title')</title>
</head>
<body>
<nav>
    <div class="container-fluid">
        <div class="row mx-5 p-2">
            <div class="col-12">
                Hi «{{\Illuminate\Support\Facades\Auth::user()->name}}», Wanna <a href="{{ route('logout') }}">Logout?</a>
            </div>
        </div>
    </div>
</nav>

@yield('content')
</body>
</html>
