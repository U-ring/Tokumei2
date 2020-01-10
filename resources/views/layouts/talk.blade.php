@extends('layouts.home')

@section('title.twitter')

@section('content')
<main class="py-4">
     <div class="kaigimei shadow">
       <h5 class="p-4">@yield('nameOf') :</h5>
     </div>
     <div class="row p-4">
       <h2>メッセージ表示欄</h2>       
     </div>
     <div class="p-4 shadow">
        <form action="bord.php" method="post" class="form-inline">
            <div>
              <label for="name">名前</label>
              <input type="text" id="name" name="name">
            </div>
            <div>
              <label for="message">内容</label>
              <input type="text" id="message" name="message">
            </div>
            <div class="form-group row">
              <label class="col-md-2">画像</label>
              <div class="col-md-10">
                  <input type="file" class="form-control-file" 
                  name="image">
              </div>
            </div>
            <input type="submit" name="send" value="送信する">
        </form>
     </div>  
</main>
@endsection