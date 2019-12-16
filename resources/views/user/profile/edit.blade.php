{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'プロフィール編集'を埋め込む --}}
@section('title', 'プロフィール編集')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form>
          <div class="mx-auto">
            <div class="col-md-4 mx-auto">
              <div class="blank-top">
              <label>名前</label>
              </div>
              <div>
                <input type="text" class="form-control">
              </div>
            </div>
          　<div class="col-md-6 mx-auto">
              　<div class="blank-top">
                  <label>プロフィール文</label>
                </div>
                <div>
                  <input type="text" class="form-control">
                </div>　  
            </div>  
          </div>
        </form>
      </div>  
    </div>
    <div class="row">
      <div class="blank-top">
        <ul>
          <li><a class="btn-primary" href="#" role="button">編集を確定する</a></li>
          <li><a class="btn-primary" href="#" role="button">Facebookも同一人物として紐づける</a></li>
          <li><a class="btn-primary" href="#" role="button">ログアウトする</a></li>
          <li><a class="btn-primary" href="#" role="button">アカウントを削除する</a></li>
        </ul>
      </div>
    </div>
  </div>
@endsection  