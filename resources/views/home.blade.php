@extends('layouts.home')

@section('title.hello')

@section('content')
 <div class="p-10">
  <p class="display-4 font-weight-bold p-4">ようこそ 匿名会議へ！</p>
  <p class="lead px-4 pt-4">あなたにとって本質的で重要なことであればあるほど、みんなは直接言いづらい。</p>
  <p class="lead px-4 pb-4">私を使ってコミュニケーションを効率化しませんか？</p>
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
       <th width="50%">ユーザー名</th>
       <th width="50%">フォロー</th>
     </tr>
     <tbody>
       @foreach($users as $user)
        <tr>
         <td>{{ $user->name}}</td>
         <td><div>@include('follow.follow_button',['user'=>$user])</div></td>
        </tr>
       @endforeach                    
     </tbody>
   </table>
 </div>
 <div>
  <ul class="nav nav-tabs nav-justified mt-5 mb-2">
   <li class="nav-item nav-link {{ Request::is('users/*/followers') ? 'active' : '' }} "><a href="{{ route('followers',['id'=>$user->id]) }}" class="">フォロワー<br><div class="badge badge-secondary"></div></a></li>
   <li class="nav-item nav-link {{ Request::is('users/*/followings') ? 'active' : '' }} "><a href="{{ route('followings',['id'=>$user->id]) }}" class="">フォロー中<br><div class="badge badge-secondary"></div></a></li>
  </ul>
 </div>
 <div class="row m-4"><a class="btn btn-primary m-3" href="/logout">ログアウト</a></div>
@endsection

