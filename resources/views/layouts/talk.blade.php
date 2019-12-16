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
        <div id="app">
            {{-- 画面上部に表示するナビゲーションバーです。 --}}
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="flex-container col-md-12">
                  <div class="row">
                    <div class="col-sm">
                      <a class="navbar-brand" href="{{ url('user/profile/home') }}">
                          {{ config('app.name', 'laravel') }}</a>
                    </div>
                        <div class="text-right">
                          @yield('edit')    
                        </div>
                  </div>
                  <div class="row">
                    <a class="navbar-brand" href="{{ action('User\ProfileController@talk') }}">トーク一覧へ</a>
                  </div>
                </div>        
            </nav>
            {{-- ここまでナビゲーションバー --}}
            <main class="py-4">
             <div class="container col-md-10 mx-auto blank-top bg-info">
               <div class="kaigimei bg-success">
                 <h5 class="m-1">@yield('nameOf') :</h5>
               </div>
                  <form action="bord.php" method="post" class="form-inline">
                    <h2>表示欄</h2>
                    <div></div>
                      <div>
                        <label for="name">名前</label>
                        <input type="text" id="name" name="name">
                      </div>
                      <div>
                        <label for="message">内容</label>
                        <input type="text" id="message" name="message">
                      </div>
                      <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" 
                            name="image">
                        </div>
                      </div>
                      <input type="submit" name="send" value="送信する">
                  </form>
             </div>
            </main>
        </div>
    </body>
</html>