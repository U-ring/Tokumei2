@extends('layouts.talk')


{{-- talk.blade.php(layouts)の@yield('title')に'匿名トーク'を埋め込む --}}
@section('title', 'メッセージ')

@section('nameOf')
  <p class="h3 mx-auto">{{ $group->name }}</p>
@endsection

@section('message')
<div class="container">
  <div id="message-data">

  </div>
</div>
{{-- <script src="{{ secure_asset('js/message.js') }}"></script> --}}

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

        if(null == data.messages[i].image) {
          var html =`
                    <div class="media message-visible m-2">
                      <div class="media-body">
                        <div class="row">
                           <span class="message-body-user font-weight-bold">${data.messages[i].name}</span>
                           <span class="message-body-content mx-4">${data.messages[i].message}</span>
                        </div>
                      </div>
                      <span class="message-body-time">${data.messages[i].created_at}</span>
                    </div>
          `;
          $("#message-data").append(html);
        } else{
          var html =`
                   <div class="media message-visible">
                      <div class="media-body">
                        <div class="row">
                           <span class="message-body-user font-weight-bold">${data.messages[i].name}</span>
                           <span class="message-body-content mx-4">${data.messages[i].message}</span>
                        </div>
                        <img src="{{ secure_asset('storage/image/${data.messages[i].image}')}}" class="rounded">
                      </div>
                      <span class="message-body-time">${data.messages[i].created_at}</span>
                    </div>
          `;
          $("#message-data").append(html);

        }

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
    <form id="message_form" action="{{ action('User\GroupController@sendC') }}" name="message_form" class="form-inline d-flex method="post" justify-content-between" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row px-2 mx-2">
        {{-- <textarea class="form-control" id="message" name="message" placeholder="push massage (shift + Enter)"aria-label="With textarea"onkeydown="if(event.shiftKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea> --}}
          <input type="text" id = "message" name="message" >
        </div>
        <div class="py-2 form-group row mx-2">
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group row float-right">
          <input type="hidden" name="group_id" value={{ $group->id }}>
          <input type="submit" id = "submit" class="btn btn-primary submit" value="送信する">
          {{-- <button type="submit" onclick="send();">送信する</button> --}}
        </div>
    </form>
<script src="{{ secure_asset('js/message.blade.js') }}"></script>
@endsection
