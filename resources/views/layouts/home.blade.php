<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
         {{-- 後の章で説明します --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        
        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app jumbotron">
            {{-- 画面上部に表示するナビゲーションバーです。 --}}
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel bg-light p-2">
                <div class="flex-container col-md-12">
                  <div class="row">
                    <div class="col-sm">
                      <a class="navbar-brand" href="{{ url('/') }}">
                          {{ config('app.name', 'laravel') }}</a>
                    </div>
                        <div class="text-right">
                          <a class="navbar-brand" href="{{ url('/') }}">Nistagram!</a>    
                        </div>
                  </div>
                </div>        
            </nav>
            <ul class="nav bg-light h6 p-4">
              <li class="nav-item px-2">
                <a class="nav-link" href="/user/home/guest">Guest</a>
              </li>
              <li class="nav-item px-2">
                <a class="nav-link" href="/user/home/facebook">Facebook</a>
              </li>
              <li class="nav-item px-2">
                <a class="nav-link" href="/user/home/twitter">Twitter</a>
              </li>
              <li class="nav-item px-2">
                <a class="nav-link" href="/user/home/talk">トーク一覧</a>
              </li>
            </ul>
            {{-- ここまでナビゲーションバー --}}
            <main>
              <div class="container shadow">
                {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                @yield('content')
              </div>  
            </main>
        </div>
    </body>
</html>