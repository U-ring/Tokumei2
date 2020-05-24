@extends('layouts.home')

@section('title.ユーザー')

@section('content')
 <div class="p-10 row">
  <p class="display-5 font-weight-bold py-4 mx-auto">フレンドと有意義なコミュニケーションを楽しみましょう。</p>
 </div>
 <div class="row d-flex justify-content-between px-4">
     <table>
       <thead>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
       </thead> 
         @foreach($friends as $friend)
          @if(isset($friend->avatar))
          <tr>
           <td style="width:60px;height:60px;"><div class="rounded-circle shadow-lg p-1"><img src="{{ $friend->avatar }}" class="rounded-circle" width="50" height="50"></div></td>
           <td width="25%">{{ $friend->name }}</td>
           <td>{{ $friend->text }}</td>
           <td><div>@include('parts.follow_button',['user'=>$friend])</div></td>
           <td><a class="btn btn-primary ml-3 my-3" href="{{ action('User\UserController@talk', ['id' => $friend->id] ) }}">トーク</a></td>
          </tr>
          @elseif(!isset($friend->avatar))
          <tr>
           <td style="width:60px;height:60px;"><div class="rounded-circle shadow-lg p-1"><img src="https://tokumeikaigi.s3.us-east-2.amazonaws.com/unknown.jpg" class="rounded-circle" width="50" height="50"></div></td>
           <td width="25%">{{ $friend->name }}</td>
           <td>{{ $friend->text }}</td>
           <td><div>@include('parts.follow_button',['user'=>$friend])</div></td>
           <td><a class="btn btn-primary ml-3 my-3" href="{{ action('User\UserController@talk', ['id' => $friend->id] ) }}">トーク</a></td>
          </tr>
          @else
         @endif
         @endforeach
     </table>
 </div>
 <div class="p-10 row">
  <p class="display-5 font-weight-bold py-4 mx-auto">まだフレンドではない仲間を発見しましょう。</p>
 </div>
 <div class="row d-flex justify-content-between px-4">
@if(isset($users))
    <table>
     <thead>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
     </thead> 
        @foreach($users as $user)
         @if(isset($user->avatar))
         <tr>
          <td style="width:60px;height:60px;"><div class="rounded-circle shadow-lg p-1"><img src="{{ secure_asset('storage/image/' . $user->avatar) }}" class="rounded-circle" width="50" height="50"></div></td>
          <td width="25%">{{ $user->name }}</td>
          <td>{{ $user->text }}</td>
          <td><div>@include('parts.follow_button',['user'=>$user])</div></td>
         </tr>
         @elseif(!isset($user->avatar))
         <tr>
          <td style="width:60px;height:60px;"><div class="rounded-circle shadow-lg p-1"><img src="https://tokumeikaigi.s3.us-east-2.amazonaws.com/unknown.jpg" class="rounded-circle" width="50" height="50"></div></td>
          <td width="25%">{{ $user->name }}</td>
          <td>{{ $user->text }}</td>
          <td><div>@include('parts.follow_button',['user'=>$user])</div></td>          
         </tr>
         @else
        @endif
        @endforeach
    </table>
@endif
   <div class="float-right m-4">
    <form action="{{ action('User\UserController@index') }}" method="get">
     <div class="form-group row">
      <label>ユーザー検索</label>
      <div>
       <input type="text" class="form-control" name="cond_name" value="{{ $cond_name }}">
      </div>
      <div>
       {{ csrf_field() }}
       <input type="submit" class="btn btn-primary" value="検索">
      </div>
     </div>
    </form>
   </div>
 </div>
 <div>
  <ul class="nav nav-tabs nav-justified mt-5 mb-2">
   <li class="nav-item nav-link {{ Request::is('users/*/followers') ? 'active' : '' }} "><a href="{{ route('followers',['id'=>Auth::id()]) }}" class="">フォロワー<br><div class="badge badge-secondary"></div></a></li>
   <li class="nav-item nav-link {{ Request::is('users/*/followings') ? 'active' : '' }} "><a href="{{ route('followings',['id'=>Auth::id()]) }}" class="">フォロー中<br><div class="badge badge-secondary"></div></a></li>
  </ul>
 </div>
 <div class="row m-4"><a class="btn btn-primary m-3" href="/logout">ログアウト</a></div>
@endsection
