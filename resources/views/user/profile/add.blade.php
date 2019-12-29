{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'アカウント新規作成'を埋め込む --}}
@section('title', 'アカウント新規作成')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
 <div class="container">
    <div class="row">
     <div class="col-md-4 mx-auto">
       <h2>アカウントを作成しましょう</h2>
       <form>
         <label>メールアドレス</label>
         <input type="text" class="form-control">
         <label>パスワード</label>
         <input type="text" class="form-control">
         <label>名前</label>
         <input type="text" class="form-control">
       </form>
     </div>     
    </div>
     <div class="row">
       <div class="col-md-6 mx-auto">
       <form>
         <label>プロフィール文</label>
         <input type="text" class="form-control">
         <div class="blank-top">
           <div class="col-md-2 mx-auto">
             <input type="submit" class="btn btn-primary" value="アカウント作成">
           </div>
         </div>
       </form>
     </div>
     </div>
 </div>
@endsection