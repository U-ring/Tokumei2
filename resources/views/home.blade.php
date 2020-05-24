@extends('layouts.home')

@section('title.hello')

@section('content')
  <div class="p-10">
   <p class="display-4 font-weight-bold p-4">ようこそ、 {{ Auth::user()->name }}さん！</p>
   <p class="lead px-4 pt-4">あなたにとって本質的で重要なことであればあるほど、みんなは直接言いづらい。</p>
   <p class="lead px-4 pb-4">匿名会議を使ってコミュニケーションを効率化しませんか？</p>
  </div>
  
    <div class="blank-top">
      <table>
       <thead>
        <tr>
          <th></th>
          <th>グループ</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
       </thead> 
          @foreach($groups as $group)
          @if(isset($group->image))
          <tr>
            <td style="width:60px;height:60px;"><div class="rounded-circle shadow-lg p-1"><img src="{{ $group->image }}" class="rounded-circle" width="50" height="50"></div></td>
            <td width="25%">{{ $group->name }}</td>
            <td><div><a class="btn btn-primary m-3" href="{{ action('User\GroupController@talk', ['id' => $group->id] ) }}">トーク</a></div></td>
            <td>
              <form action="{{ action('User\GroupController@withdraw')}}" method="post">
              @csrf
              <button type="submit" name="id" value="{{ $group->id }}" class="m-3 btn btn-danger">退会</button>
              {{-- {{ csrf_field() }} --}}
              </form>
            </td>
          </tr>
          @elseif(!isset($group->image))
          <tr>
           <td style="width:60px;height:60px;"><div class="rounded-circle shadow-lg p-1"><img src="https://tokumeikaigi.s3.us-east-2.amazonaws.com/unknown.jpg" class="rounded-circle" width="50" height="50"></div></td>
           <td width="25%">{{ $group->name }}</td>
           <td><div><a class="btn btn-primary m-3" href="{{ action('User\GroupController@talk', ['id' => $group->id] ) }}">トーク</a></div></td>
           <td>
             <form action="{{ action('User\GroupController@withdraw')}}" method="post">
             @csrf
             <button type="submit" name="id" value="{{ $group->id }}" class="m-3 btn btn-danger">退会</button>
             {{-- {{ csrf_field() }} --}}
             </form>
           </td>
          </tr>  
          @else
          @endif
          @endforeach
      </table>
    </div>
    <div class="blank-top">
      <table>
        <tr>
          <th></th>
          <th>コミュニティ</th>
          <th></th>
        </tr>
          @foreach($communities as $community)
          @if(isset($community->image))
          <tr>
            <td style="width:60px;height:60px;"><div class="rounded-circle shadow-lg p-1"><img src="{{ $community->image }}" class="rounded-circle" width="50" height="50"></div></td>
            <td width="25%">{{ $community->name }}</td>
            <div><td><a class="btn btn-primary m-3" href="{{ action('User\CommunityController@talk', ['id' => $community->id] ) }}">トーク</a></td></div>
            <div><td><a class="btn btn-primary m-3" href="{{ action('User\CommunityController@edit', ['id' => $community->id]) }}">編集</a></td></div>
          </tr>
          @elseif(!isset($community->image))
          <tr>
           <td style="width:60px;height:60px;"><div class="rounded-circle shadow-lg p-1"><img src="https://tokumeikaigi.s3.us-east-2.amazonaws.com/unknown.jpg" class="rounded-circle" width="50" height="50"></div></td>
           <td width="25%">{{ $community->name }}</td>
           <div><td><a class="btn btn-primary m-3" href="{{ action('User\CommunityController@talk', ['id' => $community->id] ) }}">トーク</a></td></div>
           <div><td><a class="btn btn-primary m-3" href="{{ action('User\CommunityController@edit', ['id' => $community->id]) }}">編集</a></td></div>
          </tr>
          @else
          @endif
          @endforeach
      </table>
    </div>
    <div class="row blank-top col-md-10 mx-auto">
      <a class="btn btn-primary m-3" href="/user/group/create">グループ作成</a>
      <a class="btn btn-primary m-3" href="/user/community/create">コミュニティ作成</a>
    </div>　
  <div class="row m-4"><a class="btn btn-primary m-3" href="/logout">ログアウト</a></div>
@endsection
