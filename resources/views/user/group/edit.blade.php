{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.edit')


{{-- edit.blade.phpの@yield('title')に'グループ編集'を埋め込む --}}
@section('title', 'グループ編集')

@section('t1','メンバー編集')
@section('t2','ボード編集')
@section('t3','残り時間の編集')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
