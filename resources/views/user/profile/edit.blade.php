{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.home')


{{-- admin.blade.phpの@yield('title')に'プロフィール編集'を埋め込む --}}
@section('title', 'プロフィール編集')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="blank-top col-md-10 mx-auto">

 <div>
   <form action="{{ action('User\ProfileController@update') }}" method="post" enctype="multipart/form-data">
     @csrf
     @if (count($errors) > 0)
     <ul>
       @foreach($errors->all() as $e)
         <li>{{ $e }}</li>
       @endforeach
     </ul>
     @endif
     <div class="form-group row">
      <label class="my-2">
        <span class="btn btn-primary">
          ファイルを選択
          <input type="file" class="form-control-file" name="avatar" style="display:none">
        </span>
      </label>
     </div>
     <div class="form-group row">
       <input type="text" name="name" value="{{ $user->name }}">
     </div>
     <div class="form-group row">
       <input type="text" name="text" value="{{ $user->text }}" >
     </div>
     <div>
       <input type="hidden" name="id" value="{{ $user->id }}"/>
       {{ csrf_field() }}
       <input type="submit" class="btn btn-primary" value="更新する">
     </div>
   </form>
 </div>
      {{-- <a class="btn btn-primary m-3" href="/user/profile/delete">このアカウントを削除する</a> --}}
</div>
@endsection
