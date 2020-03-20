{{-- layouts/talk.blade.phpを読み込む --}}
@extends('layouts.talk')


{{-- talk.blade.php(layouts)の@yield('title')に'匿名トーク'を埋め込む --}}
@section('title', '匿名トーク')

@section('nameOf')
  <p class="h3 mx-auto">{{ $group->name }}</p>
@endsection

@section('message')
     <div class="container">
  <div id="message-data">
    
  </div>
</div><script src="{{ asset('js/message.js') }}"></script>

<script>
  $(function() {
   get_message();
});
function get_message() {
  $.ajax({
    //url: "/result/ajax/",
    url: "{{ action('User\GroupController@getMessage') }}",
    dataType: "json",
    success: data => {
      $("#message-data")
          .find(".message-visible")
          .remove();
      for (var i = 0; i < data.messages.length; i++) {
         var html = `
                    <div class="media message-visible">
                      <div class="media-body">
                        <div class="row">
                           <span class="message-body-user">${data.messages[i].name}</span>
                           <span class="message-body-content">${data.messages[i].message}</span>
                        </div>
                      </div>
                      <span class="message-body-time">${data.messages[i].created_at}</span>
                    </div>
                    `;
        $("#message-data").append(html);
      }
    },
    error: () => {
       //alert("ajax Error");
    }
  });
  setTimeout("get_message()",10000);
}
</script>
@endsection

@section('form')
    <form action="{{ action('User\GroupController@send') }}" method="post" class="form-inline d-flex justify-content-between" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row px-2 mx-2">
        <textarea class="form-control" id="message" name="message" placeholder="push massage (shift + Enter)"
                aria-label="With textarea"
                onkeydown="if(event.shiftKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
        </div>
        <div class="py-2 form-group row mx-2">
            <input type="file" class="form-control-file" name="image">{{-- ※name属性あとで弄ろう --}}
        </div>
        <div class="form-group row float-right">
          <input type="hidden" name="group_id" value={{ $group->id }}>    
          <input type="submit" id="submit" class="btn btn-primary" value="送信する">
        </div>
    </form>
@endsection
