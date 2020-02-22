@extends('layouts.home')

@section('title.guest')

@section('content')
<div class="blank-top col-md-10 mx-auto">
       <div class="text-right">
         <a class="btn btn-primary blank-top" href="#">編集する</a>
       </div>
       @auth
        <div>
            <!--<img class="rounded-circle" src="{{ Auth::user()->avatar }}" width="80" height="80">-->
        </div>
       @endif
     <ul class="list-unstyled">
       <li><p class="h3 blank-top">{{ Auth::user()->name }}</p></li>
       <li class="blank-top"><p>プロフィール文</p></li>
     </ul>
    <div class="row">
      <div class="row blank-top col-md-10">
       <p class="h3 px-4">友達</p>
       <table>
         <tr>
           <th>ユーザー名</th>
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
      <div class="col-md-10">
        <table>
          <tr>
            <th>グループ名</th>
          </tr>
          <tbody>
            @foreach($groups as $item)
            <tr>
              <td>{{ }}</td>
              <!--<td>{{ $group->$users()->name }}</td>-->
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="row blank-top col-md-10 mx-auto">
      <a class="btn btn-primary m-3" href="/user/group/create">グループを作成する</a>
      <a class="btn btn-primary m-3" href="/user/community/create">コミュニティを作成する</a>
    </div>
      <a class="btn btn-primary m-3" href="/logout">ログアウト</a>
</div>

@endsection


                        