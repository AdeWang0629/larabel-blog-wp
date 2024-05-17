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
        <div class="header-container d-flex">
            <img src="{{ asset('assets/img/brand.png') }}" style="margin: auto;"/>
        </div>

        <div class="navbar-container d-flex justify-content-center">
            <ul class="nav nav-pills align-self-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('posts.index')  ? 'active' : ''}}" href="{{ route('posts.index') }}" style="margin: 15px 30px;">これまでの投稿</a>
                </li>
               @if (session()->has('user_email'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posts.create')  ? 'active' : ''}}" href="{{ route('posts.create') }}" style="margin: 15px 30px;">新たに投稿する</a>
                    </li>
               @endif
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('posts.search')  ? 'active' : ''}}" href="{{ route('posts.search') }}" style="margin: 15px 30px;">検索</a>
                </li>
                @if (session()->has('user_email'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index.blog')  ? 'active' : ''}}" href="{{ route('index.blog') }}" style="margin: 15px 30px;">ブログ</a>
                    </li>
                @endif
            </ul>
        </div>
        
        {{-- <div class="header-container">
        </div> --}}
    </header>

    <body>
        <div class="container">
            @yield('content')
        </div>

        <div class="footer-container">
            
            <div>
                <a href="https://univer-goods.com/terms/" class="footer-item">利用規約</a>
                <a href="https://univer-goods.com/privacy-policy/" class="footer-item">プライバシーポリシー</a>
                <a href="https://univer-goods.com/inquiry/" class="footer-item">お問い合わせ</a>
                <a href="https://univer-goods.com/sitemap/" class="footer-item">コンテンツ一覧</a>
                <a href="https://univer-goods.com/" class="footer-item">TOPページ</a>
            </div>

            <div class="pt-3">
                © Univerclothes All Rights Reserved.
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
    </body>
</html>