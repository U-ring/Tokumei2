{{-- layouts/talk.blade.phpを読み込む --}}
@extends('layouts.talk')


{{-- talk.blade.php(layouts)の@yield('title')に'匿名トーク'を埋め込む --}}
@section('title', '匿名トーク')


{{-- talk.blade.php(layouts)の}}
{{-- talk.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('nameOf','会議名')

@section('edit')
<a class="navbar-brand" href="{{ action('User\GroupController@edit') }}">・・・</a>
<div class="row m-4"><a class="btn btn-primary m-3" href="/logout">ログアウト</a></div>
@endsection