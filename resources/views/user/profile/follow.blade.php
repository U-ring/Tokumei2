{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'プロフィール編集'を埋め込む --}}
@section('title', 'follow')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<p>{{count($followers)}}</p>
@foreach($followers as $user)
<p>{{ $user->name }}</p>
@endforeach
@endsection