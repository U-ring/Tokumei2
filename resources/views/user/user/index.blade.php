@extends('layouts.home')

@section('title.ユーザー')

@section('content')
 <div class="p-10 row">
  <p class="display-5 font-weight-bold py-4 mx-auto">仲間と有意義なコミュニケーションを楽しみましょう。</p>
 </div>
 <div class="row d-flex justify-content-between px-4">
     <table>
       <tr>
         <th></th>
         <th></th>
         <th></th>
       </tr>
       <tbody>
         @foreach($friends as $friend)
         @if(isset($friend->facebook_id) or ($friend->twitter_id))
          <tr>
           <td><div class="rounded-circle shadow-lg p-1"><img class="rounded-circle" src="{{ $friend->avatar }}" width="50" height="50"></div></td>
           <td>{{ $friend->name}}</td>
           <td>{{ $friend->text }}</td>
           <td><div>@include('parts.follow_button',['user'=>$friend])</div></td>
           <td><a class="btn btn-primary m-3" href="{{ action('User\UserController@talk', ['id' => $friend->id] ) }}">トークを開始</a></td>
          </tr>
          @elseif(isset($friend->avatar))
          <tr>
           <td><div class="rounded-circle shadow-lg p-1"><img src="{{ asset('storage/image/' . $friend->avatar) }}" class="rounded-circle" width="50" height="50"></div></td>
           <td>{{ $friend->name }}</td>
           <td>{{ $friend->text }}</td>
           <td><div>@include('parts.follow_button',['user'=>$friend])</div></td>
           <td><a class="btn btn-primary m-3" href="{{ action('User\UserController@talk', ['id' => $friend->id] ) }}">トークを開始</a></td>
          </tr>
          @elseif(!isset($friend->avatar))
          <tr>
           <td><div class="rounded-circle shadow-lg p-1"><img src="{{ asset('storage/image/' . 'caceZ67jaTCyp7t9oVgk4KfHjRKIdfQo6Aw6exnY.jpeg') }}" class="rounded-circle" width="50" height="50"></div></td>
           <td>{{ $friend->name }}</td>
           <td>{{ $friend->text }}</td>
           <td><div>@include('parts.follow_button',['user'=>$friend])</div></td>
           <td><a class="btn btn-primary m-3" href="{{ action('User\UserController@talk', ['id' => $friend->id] ) }}">トークを開始</a></td>
          </tr>
          @else
         @endif
         @endforeach
       </tbody>
     </table>
 </div>
 <div class="p-10 row">
  <p class="display-5 font-weight-bold py-4 mx-auto">まだフレンドではない仲間を発見しましょう。</p>
 </div>
 <div class="row d-flex justify-content-between px-4">
   <div class="m-4">
     <table>
       <tr>
         <th></th>
         <th></th>
         <th></th>
       </tr>
       <tbody>
         @foreach($users as $user)
         @if(isset($user->facebook_id) or ($user->twitter_id))
          <tr>
           <td><div class="rounded-circle shadow-lg p-1"><img class="rounded-circle" src="{{ $user->avatar }}" width="50" height="50"></div></td>
           <td>{{ $user->name}}</td>
           <td>{{ $user->text }}</td>
           <td><div>@include('parts.follow_button',['user'=>$user])</div></td>
           <td><a class="btn btn-primary m-3" href="{{ action('User\UserController@talk', ['id' => $user->id] ) }}">トークを開始</a></td>
          </tr>
          @elseif(isset($user->avatar))
          <tr>
           <td><div class="rounded-circle shadow-lg p-1"><img src="{{ asset('storage/image/' . $user->avatar) }}" class="rounded-circle" width="50" height="50"></div></td>
           <td>{{ $user->name }}</td>
           <td>{{ $user->text }}</td>
           <td><div>@include('parts.follow_button',['user'=>$user])</div></td>
           <td><a class="btn btn-primary m-3" href="{{ action('User\UserController@talk', ['id' => $user->id] ) }}">トークを開始</a></td>
          </tr>
          @elseif(!isset($user->avatar))
          <tr>
           <td><div class="rounded-circle shadow-lg p-1"><img src="{{ asset('storage/image/' . 'caceZ67jaTCyp7t9oVgk4KfHjRKIdfQo6Aw6exnY.jpeg') }}" class="rounded-circle" width="50" height="50"></div></td>
           <td>{{ $user->name }}</td>
           <td>{{ $user->text }}</td>
           <td><div>@include('parts.follow_button',['user'=>$user])</div></td>
           <td><a class="btn btn-primary m-3" href="{{ action('User\UserController@talk', ['id' => $user->id] ) }}">トークを開始</a></td>
          </tr>
          @else
         @endif
         @endforeach
       </tbody>
     </table>
   </div>
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
   <li class="nav-item nav-link {{ Request::is('users/*/followers') ? 'active' : '' }} "><a href="{{ route('followers',['id'=>$user->id]) }}" class="">フォロワー<br><div class="badge badge-secondary"></div></a></li>
   <li class="nav-item nav-link {{ Request::is('users/*/followings') ? 'active' : '' }} "><a href="{{ route('followings',['id'=>$user->id]) }}" class="">フォロー中<br><div class="badge badge-secondary"></div></a></li>
  </ul>
 </div>
 <div class="row m-4"><a class="btn btn-primary m-3" href="/logout">ログアウト</a></div>
@endsection