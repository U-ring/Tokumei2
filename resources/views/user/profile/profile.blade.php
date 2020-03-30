@extends('layouts.home')

@section('title.guest')

@section('content')
<div class="blank-top col-md-10 mx-auto">
       <div class="text-right">
         <a class="btn btn-primary blank-top" href="/user/profile/edit">編集する</a>
       </div>
       @if(isset($user->facebook_id) or ($user->twitter_id))
       <div  class="col-md-12 row">
          <div class="float-left rounded-circle p-1 shadow-lg">
            <img class="rounded-circle" src="{{ Auth::user()->avatar }}" width="150" height="150">
          </div>
       </div>
          @elseif($user->avatar)
          <div class="col-md-12 row">
            <div class="float-left rounded-circle p-1 shadow-lg"><img src="{{ asset('storage/image/' . $user->avatar) }}" class="rounded-circle" width="150" height="150"></div>
          </div>
          @elseif(!isset($user->avatar))
          <div class="col-md-12 row">
            <div class="float-left rounded-circle p-1 shadow-lg"><img src="{{ asset('storage/image/' . 'Q00BoKegdjI7Yej1AxIHhmN0tKcwTzQEupTUdLsJ.jpeg') }}" class="rounded-circle" width="150" height="150"></div>            
          </div>
          @else
       @endif
       <div>
          <ul class="list-unstyled">
             <li><p class="h3 font-weight-bold text-center">{{ Auth::user()->name }}</p></li>
             <li class="blank-top text-center">{{ Auth::user()->text }}</p></li>
          </ul>
       </div>
        <div class="blank-top">
         <table>
           <tr>
             <th>フレンド</th>
           </tr>
           <tbody>
             @foreach((array)$users as $user)
              <tr>
               <td>{{ $user->name}}</td>
              </tr>
             @endforeach
           </tbody>
         </table>
        </div>
      <div class="row blank-top col-md-10">
        <table>
          <tr>
            <th>所属グループ名</th>
          </tr>
          <tbody>
            @foreach($groups as $group)
            <tr>
              <td>{{ $group->name }}</td>
              <div><td><a class="btn btn-primary m-3" href="{{ action('User\GroupController@edit', ['id' => $group->id]) }}">このグループを編集する</a></td></div>
              <div><td><a class="btn btn-primary m-3" href="{{ action('User\GroupController@talk', ['id' => $group->id] ) }}">トークを開始する</a></td></div>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    <div class="row blank-top col-md-10 mx-auto">
      <a class="btn btn-primary m-3" href="/user/group/create">グループを作成する</a>
      <a class="btn btn-primary m-3" href="/user/community/create">コミュニティを作成する</a>
    </div>
      <a class="btn btn-primary m-3" href="/logout">ログアウト</a>
</div>

@endsection
