@extends('layouts.home')

@section('title.hello')

@section('content')
 <div class="p-10">
  <p class="display-4 font-weight-bold p-4">ようこそ、 {{ Auth::user()->name }}さん！</p>
  <p class="lead px-4 pt-4">あなたにとって本質的で重要なことであればあるほど、みんなは直接言いづらい。</p>
  <p class="lead px-4 pb-4">匿名会議を使ってコミュニケーションを効率化しませんか？</p>
 </div>
 <div class="row float-right m-4">
  <form action="{{ action('HomeController@index') }}" method="get">
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
 <div class="row m-4">
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
        </tr>
        @elseif(isset($user->avatar))
        <tr>
         <td><div class="rounded-circle shadow-lg p-1"><img src="{{ secure_asset('storage/image/' . $user->avatar) }}" class="rounded-circle" width="50" height="50"></div></td>
         <td>{{ $user->name }}</td>
         <td>{{ $user->text }}</td>
         <td><div>@include('parts.follow_button',['user'=>$user])</div></td>
        </tr>
        @else
       @endif 
       @endforeach                    
     </tbody>
   </table>
 </div>
  <a class="btn btn-primary m-3" href="/user/group/create">グループを作成する</a>
 <div>
  <ul class="nav nav-tabs nav-justified mt-5 mb-2">
   <li class="nav-item nav-link {{ Request::is('users/*/followers') ? 'active' : '' }} "><a href="{{ route('followers',['id'=>$user->id]) }}" class="">フォロワー<br><div class="badge badge-secondary"></div></a></li>
   <li class="nav-item nav-link {{ Request::is('users/*/followings') ? 'active' : '' }} "><a href="{{ route('followings',['id'=>$user->id]) }}" class="">フォロー中<br><div class="badge badge-secondary"></div></a></li>
  </ul>
 </div>
 <div class="row m-4"><a class="btn btn-primary m-3" href="/logout">ログアウト</a></div>
@endsection

