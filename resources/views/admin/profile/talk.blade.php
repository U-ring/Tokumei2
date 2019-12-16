{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'トーク一覧'を埋め込む --}}
@section('title', 'トーク一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
  <main class="p-3">
    <ul class="nav nav-tabs">
      <li class="nav-item p-3">
        <a href="#" class="nav-link active" data-toggle="tab">Twitter</a>
      </li>
      <li class="nav-item p-3">
        <a href="#" class="nav-item" data-toggle="tab">Instagram</a>
      </li>
      <li class="nav-item p-3">
        <a href="#" class="nav-item" data-toggle="tab">Twitter</a>
      </li>
      <li class="nav-item p-3">
        <a href="#" class="nav-item" data-toggle="tab">Facebook</a>
      </li>
      <li class="nav-item p-3">
        <a href="#" class="nav-item" data-toggle="tab">トーク一覧</a>
      </li>
    </ul>
  </main>
  <div class="talkSearch col-md-3 mx-auto blank-top">
    <form>
      <input type="text" class="form-control">
    </form>  
  </div>
</div>
@endsection