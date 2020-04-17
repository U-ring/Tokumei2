@extends('layouts.home')

@section('title.プロフィール')

@section('content')
<div class="blank-top col-md-10 mx-auto">
       <div class="text-right">
         <a class="btn btn-primary blank-top" href="/user/profile/edit">編集する</a>
       </div>
          @if($user->avatar)
          <div class="col-md-12 row">
            <div class="float-left rounded-circle p-1 shadow-lg"><img src="{{ $user->avatar }}" class="rounded-circle" width="150" height="150"></div>
          </div>
          @elseif(!isset($user->avatar))
          <div class="col-md-12 row">
            <div class="float-left rounded-circle p-1 shadow-lg"><img src="https://tokumeikaigi.s3.us-east-2.amazonaws.com/unknown.jpg" class="rounded-circle" width="150" height="150"></div>
          </div>
          @else
       @endif
       <div>
          <ul class="list-unstyled">
             <li><p class="h3 font-weight-bold text-center">{{ Auth::user()->name }}</p></li>
             <li class="blank-top text-center">{{ Auth::user()->text }}</p></li>
          </ul>
       </div>
    </div>
      <a class="btn btn-primary m-3" href="/logout">ログアウト</a>
</div>

@endsection
