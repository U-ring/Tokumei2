{{-- layouts/talk.blade.phpを読み込む --}}
@extends('layouts.talk')


{{-- talk.blade.php(layouts)の@yield('title')に'コミュニティトーク'を埋め込む --}}
@section('title', 'コミュニティトーク')

{{-- talk.blade.php(layouts)の}}
{{-- talk.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('nameOf','コミュニティ名')