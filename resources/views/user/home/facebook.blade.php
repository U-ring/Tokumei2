@extends('layouts.home')

@section('title.facebook')

@section('content')
<div class="blank-top col-md-10 mx-auto">
     <div class="col-md-12">
       <div class="text-right">
         <a class="btn btn-primary blank-top" href="#">編集する</a>
       </div>
     </div>
      @auth
        <div>
            <img class="rounded-circle" src="{{ Auth::user()->avatar }}" width="80" height="80">
        </div>
      @endif
     <ul class="list-unstyled">
       <li><p class="h3 blank-top">{{ Auth::user()->name }}</p></li>
       <li class="blank-top"><p>プロフィール文</p></li>
       <li><p>Twitterでログインしています</p></li>
       <li><p>Instagramでログインしています</p></li> 
     </ul>
    </div>
    <div class="row blank-top col-md-10 mx-auto">
      <div class="col-md-12">
        <p class="h2">友達リスト</p>
        <p class="blank-top">{{ Auth::User()->twitter_id }}</p>
      </div>
    </div>
    <div class="d-flex row col-md-10 mx-auto clearfix">
      <div class="justify-content-start">  
        <form>
         <div class="col-md-8 blank-top">
           <ul class="list-inline">
             <li class="list-inline-item">
               <input type="text" class="form-control">
             </li>
             <li class="list-inline-item">
               <a href="#">作成</a>
             </li>
           </ul>
         </div>
         <div class="col-md-8 blank-top">
           <ul class="list-inline">
            <li class="list-inline-item">
              <input type="text" class="form-control">
            </li>
            <li class="list-inline-item">
              <a href="#">作成</a>
            </li>
           </ul>            
         </div>
        </form>
      <div data-spy="scroll" class="blank-top scrollspy-example justify-content-end">
        <p class="h2">知り合いかも？</p>
        <p>A君</p>
        <p>B君</p>
      </div>
      </div>    
</div>
<div class="row m-4"><a class="btn btn-primary m-3" href="/logout">ログアウト</a></div>
@endsection