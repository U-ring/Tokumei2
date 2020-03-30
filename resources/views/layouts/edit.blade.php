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
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            {{-- 画面上部に表示するナビゲーションバーです。 --}}
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="flex-container col-md-12">
                  <div class="row">
                    <div class="col-sm">
                      <a class="navbar-brand" href="{{ url('user/profile/home') }}">
                          {{ config('app.name', 'laravel') }}</a>
                    </div>
                  </div>
                  <div class="row">
                    <a class="navbar-brand" href="{{ action('User\ProfileController@talk') }}">トーク一覧へ</a>
                  </div>
                </div>
            </nav>
            <div class="container">
              <main class="p-3">
                <ul class="nav nav-tabs">
                  <li class="nav-item p-3">
                    <a href="#" class="nav-item" data-toggle="tab">@yield('t1')</a>
                  </li>
                  <li class="nav-item p-3">
                    <a href="#" class="nav-item" data-toggle="tab">@yield('t2')</a>
                  </li>
                  <li class="nav-item p-3">
                    <a href="#" class="nav-item" data-toggle="tab">@yield('t3')</a>
                  </li>
                </ul>
              </main>
              <div class="blank-top bg-success">
                <div class="row d-flex justify-content-between">
                    <p class="m-4">メンバーに招待</p>
                    <form>
                     <input type="text" class="form-control m-4">
                    </form>
                    <form>
                      <input type="submit" class="btn btn-primary m-4" value="招待する">
                    </form>
                 </div>
                 <div class="row d-flex justify-content-between">
                   <div class="member">@yield('member')</div>
                   <form>
                     <input type="submit" class="btn btn-primary m-4" value="退会させる">
                   </form>
                 </div>
                 <div class="row d-flex justify-content-center blank-top">
                   <form>
                     <input type="submit" class="btn btn-primary m-4" value="このグループの通知をOFFにする">
                   </form>
                 </div>
              </div>
        </div>
    </body>
</html>
