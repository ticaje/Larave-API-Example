<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My blog made in Laravel</title>
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar-expand justify-content-center">
    <div class="container-fluid">
        <ul class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/')}}">Home</a>
                </li>
                @if (!Auth::guest() && Auth::user()->can_post())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/user/'.Auth::id().'/posts') }}">Published</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/user/'.Auth::id().'/my-drafts') }}">In Draft</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/new-post') }}">New Post</a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav">
                @if (Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/user/'.Auth::id()) }}">Me</a>
                    </li>
                    <li class="d-flex me-2">
                        <a class="nav-link" href="{{ url('/auth/logout') }}">Logout</a>
                    </li>
                @endif
            </ul>
    </div>
</nav>
<div class="container">
    @if (Session::has('message'))
    <div class="flash alert-info">
        <p class="panel-body">
            {{ Session::get('message') }}
        </p>
    </div>
    @endif
    @if ($errors->any())
    <div class='flash alert-danger'>
        <ul class="panel-body">
            @foreach ( $errors->all() as $error )
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>@yield('title')</h2>
                    @yield('title-meta')
                </div>
                <div class="panel-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</html>
