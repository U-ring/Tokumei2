{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ホーム'を埋め込む --}}
@section('title', 'ホーム')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
  <div class="container">
    <main class="p-3">
      <ul class="nav nav-tabs">
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
    </main>
      <div class="tab-content">
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
  </div>
@endsection