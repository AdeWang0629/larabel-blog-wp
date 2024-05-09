<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>UniverFoods.com</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- custom css -->
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    </head>
    
    <header>
        <div class="header-container">
        </div>
        <div class="navbar-container d-flex justify-content-center">
            <ul class="nav nav-pills align-self-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('posts.index')  ? 'active' : ''}}" href="{{ route('posts.index') }}">これまでの投稿</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('posts.create')  ? 'active' : ''}}" href="{{ route('posts.create') }}">新たに投稿する</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">検索</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ブログ</a>
                </li>
            </ul>
        </div>
        <div class="header-container">
        </div>
    </header>

    <body>
        <div class="container">
            @yield('content')
        </div>

        <div class="footer-container d-flex justify-content-center">
            © Univerclothes All Rights Reserved.
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>