<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
         {{-- 後の章で説明します --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>A君の編集</title>

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
                  </div>
                  <div class="row">
                    <a class="navbar-brand" href="{{ action('User\ProfileController@talk') }}">トーク一覧へ</a>
                  </div>
                </div>        
            </nav>
            <div class="blank-top bg-success">
              <form>
                <div class="row m-2">
                  <input type="submit" class="btn btn-primary mx-auto m-5" value="この人物からの通知をOFFにする">
                </div>
                <div class="row m-2">
                  <input type="submit" class="btn btn-primary mx-auto m-5" value="この人物をブロックする">
                </div>
              </form>
            </div>
　　　　</div>
　　</body>
</html>　　