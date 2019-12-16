{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'匿名会議ログイン'を埋め込む --}}
@section('title', '匿名会議ログイン')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>匿名会議ログイン</h2>
                <form>
                  <div class=" .mx-auto">
                    <label>メールアドレス</label>        
                    <div>
                        <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class=" .mx-auto">
                    <label>パスワード</label>
                  　<div>
                  　     <input type="text" class="form-control">
                  　</div>
                  </div>
                </form>
            </div>
        </div>
          <div class="row">
            <div class="blank-top">
              <div class="col-md-12 mt-10">
              <ul>
                <li><a href="{{ action('User\ProfileController@add')}}">アカウントを新規作成</a></li>
                <li><a href="#">+Instagramでログイン</a></li>
                <li><a href="#">+Twitterでログイン</a></li>
                <li><a href="#">+Facebookでログイン</a></li>
              </ul>
              </div>
            </div>
          </div>    
        </div>
    </div>
@endsection