<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('css/app.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <script src="{{asset('js/app.js')}}"></script>
        <title>@yield('title')</title>
    </head>
    <body>
        <div class="container-fluid p-1">
            <nav class="navbar navbar-expand navbar-light bg-light fixed-top p-1 border-bottom">
                <a href="{{ url('/messages') }}" class="navbar-brand">グループ掲示板</a>
                <ul class="navbar-nav">
                    @if(Auth::check())
                    <li class="nav-item"><a href="{{ url ('/messages') }}" class="nav-link"><i class="fas fa-home"></i>ホーム</a></li>
                    <li class="nav-item"><a href="{{ url('/archive') }}" class="nav-link"><i class="fas fa-archive"></i>アーカイブ</a></li>
                    @else
                    <li class="nav-item"><a href="{{ route('user.signup')}}" class="nav-link">新規登録</a></li>
                    @endif
                </ul>
                @if(Auth::check())
                <ul class="navbar-nav ml-auto">
                    <!--<li class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#modal1">メッセージを追加</a></li>-->
                    <li class="nav-item"><a href="{{ route('user.logout') }}" class="nav-link">ログアウト</a></li>
                </ul>
                @endif
            </nav>
        </div>
        @yield('content')
        <script>$('[data-toggle="tooltip"]').tooltip()</script>
    </body>
</html>