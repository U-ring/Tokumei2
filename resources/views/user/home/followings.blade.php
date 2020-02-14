@extends('layouts.home')

@section('title.フォロー一覧')

@section('content')
<div class="p-4"><p class="h3">フォロー一覧</p></div>
<div class="row m-4 pb-4">
  <table>
    @foreach($users as $user)
    <tr></tr>
    <td>{{ $user->follows()->name }}</td><!--follows()は、Follow.phpのfollows()関数。-->
    <td>@include('follow.follow_button',['user'=>$user])</td>
    @endforeach
  </table>
</div>
@endsection