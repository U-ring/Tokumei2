@extends('layouts.home')

@section('title.フォロワー一覧')

@section('content')
<div class="p-4"><p class="h3">フォロワー一覧</p></div>
<div class="row m-4 pb-4">
  <table>
    @foreach($users as $user)
    <tr></tr>
    <td>{{ $user->follower()->name }}</td>
    <td>@include('follow.follow_button',['user'=>$user])</td>
    @endforeach
  </table>
</div>
@endsection


