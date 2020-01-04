{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'プロフィール編集'を埋め込む --}}
@section('title', 'follow')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
@foreach($followers->users as $user)
<p>{{ $user->name }}</p>
@endforeach
@endsection