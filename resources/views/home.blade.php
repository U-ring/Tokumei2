@extends('layouts.home')

@section('title.hello')

@section('content')
  <div class="p-10">
   <p class="display-4 font-weight-bold p-4">ようこそ、 {{ Auth::user()->name }}さん！</p>
   <p class="lead px-4 pt-4">あなたにとって本質的で重要なことであればあるほど、みんなは直接言いづらい。</p>
   <p class="lead px-4 pb-4">匿名会議を使ってコミュニケーションを効率化しませんか？</p>
  </div>
  <div class="d-flex justify-content-between px-4">
    <div class="blank-top">
      <table>
        <tr>
          <th></th>
          <th>グループ</th>
          <th></th>
        </tr>
        <tbody>
          @foreach($groups as $group)
          @if(isset($group->image))
          <tr>
            <td><div class="rounded-circle shadow-lg p-1"><img src="{{ secure_asset('storage/image/' . $group->image) }}" class="rounded-circle" width="50" height="50"></div></td>
            <td>{{ $group->name }}</td>
            <div><td><a class="btn btn-primary m-3" href="{{ action('User\GroupController@talk', ['id' => $group->id] ) }}">トークを開始</a></td></div>
            <form action="{{ action('User\GroupController@withdraw')}}" method="post">
              @csrf
              <td><button type="submit" name="id" value="{{ $group->id }}" class="m-2 btn btn-danger">退会する</button></td>
              {{-- {{ csrf_field() }} --}}
            </form>
          </tr>
          @elseif(!isset($group->image))
          <tr>
           <td><div class="rounded-circle shadow-lg p-1"><img src="{{ secure_asset('storage/image/' . 'PpnG7mWNSuOG4o4JZn2VItzkk7vIt9zLVk3zJybe.jpeg') }}" class="rounded-circle" width="50" height="50"></div></td>
           <td>{{ $group->name }}</td>
           <td>{{ $group->text }}</td>
           <div><td><a class="btn btn-primary m-3" href="{{ action('User\GroupController@talk', ['id' => $group->id] ) }}">トークを開始</a></td></div>
           <form action="{{ action('User\GroupController@withdraw')}}" method="post">
             @csrf
             <td><button type="submit" name="id" value="{{ $group->id }}" class="m-2 btn btn-danger">退会する</button></td>
             {{-- {{ csrf_field() }} --}}
           </form>
          </tr>
          @else
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="blank-top">
      <table>
        <tr>
          <th></th>
          <th>コミュニティ</th>
          <th></th>
        </tr>
        <tbody>
          @foreach($communities as $community)
          @if(isset($community->image))
          <tr>
            <td><div class="rounded-circle shadow-lg p-1"><img src="{{ secure_asset('storage/image/' . $community->image) }}" class="rounded-circle" width="50" height="50"></div></td>
            <td>{{ $community->name }}</td>
            <div><td><a class="btn btn-primary m-3" href="{{ action('User\CommunityController@talk', ['id' => $community->id] ) }}">トークを開始</a></td></div>
            <div><td><a class="btn btn-primary m-3" href="{{ action('User\CommunityController@edit', ['id' => $community->id]) }}">編集</a></td></div>
          </tr>
          @elseif(!isset($community->image))
          <tr>
           <td><div class="rounded-circle shadow-lg p-1"><img src="{{ secure_asset('storage/image/' . 'PpnG7mWNSuOG4o4JZn2VItzkk7vIt9zLVk3zJybe.jpeg') }}" class="rounded-circle" width="50" height="50"></div></td>
           <td>{{ $community->name }}</td>
           <td>{{ $community->text }}</td>
           <div><td><a class="btn btn-primary m-3" href="{{ action('User\CommunityController@talk', ['id' => $community->id] ) }}">トークを開始</a></td></div>
           <div><td><a class="btn btn-primary m-3" href="{{ action('User\CommunityController@edit', ['id' => $community->id]) }}">編集</a></td></div>
          </tr>
          @else
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
    <div class="row blank-top col-md-10 mx-auto">
      <a class="btn btn-primary m-3" href="/user/group/create">グループを作成</a>
      <a class="btn btn-primary m-3" href="/user/community/create">コミュニティを作成</a>
    </div>　
  <div class="row m-4"><a class="btn btn-primary m-3" href="/logout">ログアウト</a></div>
@endsection
