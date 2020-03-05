@extends('layouts.home')

@section('title.guest')

@section('content')
<div class="blank-top col-md-10 mx-auto">
       <div class="text-right">
         <a class="btn btn-primary blank-top" href="/user/profile/edit">編集する</a>
       </div>
       @auth
        <div>
            <!--<img class="rounded-circle" src="{{ Auth::user()->avatar }}" width="80" height="80">-->
        </div>
       @endif
      <div class="col-md-4 mx-auto">
        <ul class="list-unstyled">
           <li><p class="h3 font-weight-bold blank-top">{{ Auth::user()->name }}</p></li>
           <li class="blank-top">{{ Auth::user()->text }}</p></li>
        </ul>
      </div>
      <div class="row blank-top col-md-10">
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
            <th>グループ名</th>
          </tr>
          <tbody>
            @foreach($groups as $group)
            <tr>
              <td>{{ $group->name }}</td>
              <div><td><a class="btn btn-primary m-3" href="{{ action('User\GroupController@edit', ['id' => $group->id]) }}">このグループを編集する</a></td></div>
              <div><td><a class="btn btn-primary m-3" href="{{ action('User\GroupController@talk', ['id' => $group->id] ) }}">トークを開始する</a></td></div>
              {{-- <td><a class="btn btn-primary m-3" href="/user/group/edit">このグループを編集する</a></td> --}}
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


                        