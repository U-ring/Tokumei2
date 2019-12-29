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
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel bg-light">
                <div class="flex-container col-md-12">
                  <div class="row">
                    <div class="col-sm">
                      <a class="navbar-brand" href="{{ url('user/profile/home') }}">
                          {{ config('app.name', 'laravel') }}</a>
                    </div>
                        <div class="text-right">
                          <a class="navbar-brand" href="{{ url('/') }}">Nistagram!</a>    
                        </div>
                  </div>
                </div>        
            </nav>
            {{-- ここまでナビゲーションバー --}}
                      <ul class="nav nav-tabs nav-fill bg-light">
                        <li class="nav-item p-3">
                          <a href="#t0" class="nav-link" data-toggle="tab">Guest</a>
                        </li>
                        <li class="nav-item p-3">
                          <a href="#t1" class="nav-link active" data-toggle="tab">Twitter</a>
                        </li>
                        <li class="nav-item p-3">
                          <a href="#t2" class="nav-link" data-toggle="tab">Instagram</a>
                        </li>
                        <li class="nav-item p-3">
                          <a href="#t3" class="nav-link" data-toggle="tab">Facebook</a>
                        </li>
                        <li class="nav-item p-3">
                          <a href="#t4" class="nav-link" data-toggle="tab">トーク一覧</a>
                        </li>
                      </ul>
            <main class="py-4">
                <div class="container shadow-lg">
                    <div class="tab-content">
                      <div id="t0" class="tab-pane">
                        <div class="blank-top col-md-10 mx-auto">
                             <div class="col-md-12">
                               <div class="text-right">
                                 <a class="btn btn-primary blank-top" href="#">編集する</a>
                               </div>
                             </div>
                              @auth
                                <div>
                                    <img class="rounded-circle" src="{{ Auth::user()->avatar }}" width="80" height="80">
                                </div>
                              @endif
                             <ul class="list-unstyled">
                               <li><p class="h3 blank-top">{{ Auth::user()->name }}</p></li>
                               <li class="blank-top"><p>プロフィール文</p></li>
                               <li><p>Twitterでログインしています</p></li>
                               <li><p>Instagramでログインしています</p></li> 
                             </ul>
                          </div>
                          <div class="row blank-top col-md-10 mx-auto">
                              <div class="col-md-12">
                                <p class="h2">友達リスト</p>
                                <ul class="list-inline blank-top">
                                  <li class="list-inline-item">+ A君</li>
                                  <li class="list-inline-item">情報</li>
                                  <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                                </ul>
                                <ul class="list-inline">
                                  <li class="list-inline-item">+ B君</li>
                                  <li class="list-inline-item">情報</li>
                                  <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                                </ul>
                                <ul class="list-inline">
                                  <li class="list-inline-item">+ C君</li>
                                  <li class="list-inline-item">情報</li>
                                  <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                                </ul>
                              </div>
                          </div>
                          <div class="d-flex row col-md-10 mx-auto clearfix">
                              <div class="justify-content-start">  
                                <form>
                                 <div class="col-md-8 blank-top">
                                   <ul class="list-inline">
                                     <li class="list-inline-item">
                                       <input type="text" class="form-control">
                                     </li>
                                     <li class="list-inline-item">
                                       <a href="#">作成</a>
                                     </li>
                                   </ul>
                                 </div>
                                 <div class="col-md-8 blank-top">
                                   <ul class="list-inline">
                                    <li class="list-inline-item">
                                      <input type="text" class="form-control">
                                    </li>
                                    <li class="list-inline-item">
                                      <a href="#">作成</a>
                                    </li>
                                   </ul>            
                                 </div>
                                </form>
                              <div class="blank-top justify-content-end">
                                    <p class="h2">知り合いかも？</p>
                                  <ul class="list-inline">
                                    <li class="list-inline-item">G君</li>
                                    <li class="list-inline-item">情報</li>
                                    <li class="list-inline-item"><a href="#">追加</a></li>
                                  </ul>
                              </div>
                              </div>    
                        </div>
                      </div>
                      <div id="t1" class="tab-pane active">
                        <div class="bg-success blank-top col-md-10 mx-auto">
                           <div class="col-md-12">
                             <div class="text-right">
                               <a href="#">編集する</a>
                             </div>
                           </div>
                           <ul>
                           <li><p>名前 twitterログイン  </p></li>
                             <li><p>プロフィール文</p></li>
                             <li><p>Twitterでログインしています</p></li>
                             <li><p>Instagramでログインしています</p></li> 
                           </ul>
                        </div>
                        <div class="row bg-success blank-top col-md-10 mx-auto">
                            <div class="col-md-12">
                              <ul class="list-inline">
                                <li class="list-inline-item">+ A君</li>
                                <li class="list-inline-item">情報</li>
                                <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                              </ul>
                              <ul class="list-inline">
                                <li class="list-inline-item">+ B君</li>
                                <li class="list-inline-item">情報</li>
                                <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                              </ul>
                              <ul class="list-inline">
                                <li class="list-inline-item">+ C君</li>
                                <li class="list-inline-item">情報</li>
                                <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                              </ul>
                            </div>
                        </div>
                        <div class="d-flex row col-md-10 mx-auto clearfix">
                            <div class="justify-content-start">  
                              <form>
                               <div class="col-md-4 bg-success blank-top">
                                 <ul class="list-inline">
                                   <li class="list-inline-item">
                                     <input type="text" class="form-control">
                                   </li>
                                   <li class="list-inline-item">
                                     <a href="#">作成</a>
                                   </li>
                                 </ul>
                               </div>
                               <div class="col-md-4 bg-success blank-top">
                                 <ul class="list-inline">
                                  <li class="list-inline-item">
                                    <input type="text" class="form-control">
                                  </li>
                                  <li class="list-inline-item">
                                    <a href="#">作成</a>
                                  </li>
                                 </ul>            
                               </div>
                              </form>
                            </div>  
                              <div class="col-md-2 bg-success blank-top justify-content-end">
                                  <div class="mx-auto">
                                    <p>知り合いかも？</p>
                                  </div>
                                  <ul class="list-inline">
                                    <li class="list-inline-item">G君</li>
                                    <li class="list-inline-item">情報</li>
                                    <li class="list-inline-item"><a href="#">追加</a></li>
                                  </ul>
                              </div>  
                        </div>
                      </div>
                      <div id="t2" class="tab-pane">
                        <div class="bg-success blank-top col-md-10 mx-auto">
                             <div class="col-md-12">
                               <div class="text-right">
                                 <a href="#">編集する</a>
                               </div>
                             </div>
                             <ul>
                               <li><p>名前 instaログイン</p></li>
                               <li><p>プロフィール文</p></li>
                               <li><p>Twitterでログインしています</p></li>
                               <li><p>Instagramでログインしています</p></li> 
                             </ul>
                          </div>
                          <div class="row bg-success blank-top col-md-10 mx-auto">
                              <div class="col-md-12">
                                <ul class="list-inline">
                                  <li class="list-inline-item">+ A君</li>
                                  <li class="list-inline-item">情報</li>
                                  <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                                </ul>
                                <ul class="list-inline">
                                  <li class="list-inline-item">+ B君</li>
                                  <li class="list-inline-item">情報</li>
                                  <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                                </ul>
                                <ul class="list-inline">
                                  <li class="list-inline-item">+ C君</li>
                                  <li class="list-inline-item">情報</li>
                                  <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                                </ul>
                              </div>
                          </div>
                          <div class="d-flex row col-md-10 mx-auto clearfix">
                              <div class="justify-content-start">  
                                <form>
                                 <div class="col-md-4 bg-success blank-top">
                                   <ul class="list-inline">
                                     <li class="list-inline-item">
                                       <input type="text" class="form-control">
                                     </li>
                                     <li class="list-inline-item">
                                       <a href="#">作成</a>
                                     </li>
                                   </ul>
                                 </div>
                                 <div class="col-md-4 bg-success blank-top">
                                   <ul class="list-inline">
                                    <li class="list-inline-item">
                                      <input type="text" class="form-control">
                                    </li>
                                    <li class="list-inline-item">
                                      <a href="#">作成</a>
                                    </li>
                                   </ul>            
                                 </div>
                                </form>
                              </div>  
                                <div class="col-md-2 bg-success blank-top justify-content-end">
                                    <div class="mx-auto">
                                      <p>知り合いかも？</p>
                                    </div>
                                    <ul class="list-inline">
                                      <li class="list-inline-item">G君</li>
                                      <li class="list-inline-item">情報</li>
                                      <li class="list-inline-item"><a href="#">追加</a></li>
                                    </ul>
                                </div>  
                        </div>
                      </div>
                      <div id="t3" class="tab-pane">
                        <div class="bg-success blank-top col-md-10 mx-auto">
                             <div class="col-md-12">
                               <div class="text-right">
                                 <a href="#">編集する</a>
                               </div>
                             </div>
                             <ul>
                               <li><p>名前 Facebookログイン</p></li>
                               <li><p>プロフィール文</p></li>
                               <li><p>Twitterでログインしています</p></li>
                               <li><p>Instagramでログインしています</p></li> 
                             </ul>
                          </div>
                          <div class="row bg-success blank-top col-md-10 mx-auto">
                              <div class="col-md-12">
                                <ul class="list-inline">
                                  <li class="list-inline-item">+ A君</li>
                                  <li class="list-inline-item">情報</li>
                                  <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                                </ul>
                                <ul class="list-inline">
                                  <li class="list-inline-item">+ B君</li>
                                  <li class="list-inline-item">情報</li>
                                  <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                                </ul>
                                <ul class="list-inline">
                                  <li class="list-inline-item">+ C君</li>
                                  <li class="list-inline-item">情報</li>
                                  <li class="list-inline-item"><a href="#">チャットを開始する</a></li>
                                </ul>
                              </div>
                          </div>
                          <div class="d-flex row col-md-10 mx-auto clearfix">
                              <div class="justify-content-start">  
                                <form>
                                 <div class="col-md-4 bg-success blank-top">
                                   <ul class="list-inline">
                                     <li class="list-inline-item">
                                       <input type="text" class="form-control">
                                     </li>
                                     <li class="list-inline-item">
                                       <a href="#">作成</a>
                                     </li>
                                   </ul>
                                 </div>
                                 <div class="col-md-4 bg-success blank-top">
                                   <ul class="list-inline">
                                    <li class="list-inline-item">
                                      <input type="text" class="form-control">
                                    </li>
                                    <li class="list-inline-item">
                                      <a href="#">作成</a>
                                    </li>
                                   </ul>            
                                 </div>
                                </form>
                              </div>  
                                <div class="col-md-2 bg-success blank-top justify-content-end">
                                    <div class="mx-auto">
                                      <p>知り合いかも？</p>
                                    </div>
                                    <ul class="list-inline">
                                      <li class="list-inline-item">G君</li>
                                      <li class="list-inline-item">情報</li>
                                      <li class="list-inline-item"><a href="#">追加</a></li>
                                    </ul>
                                </div>  
                          </div>
                      </div>
                      <div id="t4" class="tab-pane">
                        <div class="talkSearch col-md-3 mx-auto blank-top">
                          <form>
                            <input type="text" class="form-control">
                          </form>  
                        </div>
                      </div>
                    </div>
                    <div class="row m-4"><a class="btn btn-primary m-3" href="/logout">ログアウト</a></div>
                  </main>  
                </div> 
            </main>
        </div>
    </body>
</html>