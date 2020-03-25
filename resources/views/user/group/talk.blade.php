@extends('layouts.talk')


{{-- talk.blade.php(layouts)の@yield('title')に'匿名トーク'を埋め込む --}}
@section('title', 'グループトーク')

@section('nameOf')
  <p class="h3 mx-auto">{{ $group->name }}</p>
@endsection

@section('message')
<div class="container">
  <div id="message-data">
    
  </div>
</div>
{{-- <script src="{{ asset('js/message.js') }}"></script> --}}

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
        } else{
          var html =`
                   <div class="media message-visible">
                      <div class="media-body">
                        <div class="row">
                           <span class="message-body-user">${data.messages[i].name}</span>
                           <span class="message-body-content">${data.messages[i].message}</span>
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
    <form id="message_form" action="{{ action('User\GroupController@sendM') }}" name="message_form" class="form-inline d-flex method="post" justify-content-between" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row px-2 mx-2">
        {{-- <textarea class="form-control" id="message" name="message" placeholder="push massage (shift + Enter)"aria-label="With textarea"onkeydown="if(event.shiftKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea> --}}
          <input type="text" id = "message" name="message" >
        </div>
        <div class="py-2 form-group row mx-2">
            <input type="file" class="form-control-file" name="image">{{-- ※name属性あとで弄ろう --}}
        </div>
        <div class="form-group row float-right">
          <input type="hidden" name="group_id" value={{ $group->id }}>    
          <input type="submit" id = "submit" class="btn btn-primary submit" value="送信する">
          
        </div>
    </form>
    <script>
      $('#message_form').submit(function(event) {
    // HTMLでの送信をキャンセル
    event.preventDefault();
    var $form = $(this);
    var $button = $form.find('.submit');
    $.ajax({
        url: "{{ action('User\GroupController@sendM') }}",
        type: "POST",
        data: $form.serialize(),
        timeout: 10000,  // 単位はミリ秒
        // 送信前
        beforeSend: function(xhr, settings) {
            // ボタンを無効化し、二重送信を防止
            $button.attr('disabled', true);
        },
        // 応答後
        complete: function(xhr, textStatus) {
            // ボタンを有効化し、再送信を許可
            $button.attr('disabled', false);
        },
        // 通信成功時の処理
        success: function(result, textStatus, xhr) {
            // 入力値を初期化
            $form[0].reset();
            // $("#result").append(result);
              $(function() {
               get_message();
            });
        },
        // 通信失敗時の処理
        error: function(xhr, textStatus, error) {
            alert('送信できませんでした。');
        }
    });
    // …
});
    </script>
@endsection
