@extends('layouts.talk')


{{-- talk.blade.php(layouts)の@yield('title')に'匿名トーク'を埋め込む --}}
@section('title', 'コミュニティトーク')

@section('nameOf')
  <p class="h3 mx-auto">{{ $community->name }}</p>
@endsection

@section('message')
<div class="container">
  <div id="message-data">

  </div>
</div>
{{-- <script src="{{ asset('js/message.js') }}"></script> --}}

<script>

function get_messageC() {
  $.ajax({
    //url: "/result/ajax/",
    url: "{{ action('User\CommunityController@getMessageC',['id'=>$community->id]) }}",
    dataType: "json",
    success: data => {
      $("#message-data")
          .find(".message-visible")
          .remove();
      for (var i = 0; i < data.messages.length; i++) {

        if(null == data.messages[i].image) {
          var html =`
                    <div class="media message-visible m-4">
                      <div class="media-body">
                        <div class="row my-2">
                           <span class="message-body-user font-weight-bold h4">${data.messages[i].name}</span>
                           <span class="message-body-time mx-4 h5">${data.messages[i].created_at}</span>
                        </div>
                        <div class="row">
                          <span class="message-body-content mx-4 h5">${data.messages[i].message}</span>
                        </div>
                      </div>
                    </div>
          `;
          $("#message-data").append(html);
        } else{
          var html =`
                   <div class="media message-visible m-4">
                      <div class="media-body">
                        <div class="row my-2">
                           <span class="message-body-user font-weight-bold h4">${data.messages[i].name}</span>
                           <span class="message-body-time mx-4 h5">${data.messages[i].created_at}</span>
                        </div>
                        <div class="row">
                          <span class="message-body-content mx-4 h5">${data.messages[i].message}</span>
                        </div>
                        <div class="row">
                          <img src="${data.messages[i].image}" class="rounded float-right mt-2" width="300" height="300">
                        </div>
                      </div>
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
  setTimeout("get_messageC()",10000);
}
</script>
@endsection

@section('form')
    <form id="message_form" action="{{ action('User\CommunityController@sendC') }}" name="message_form" class="form-inline d-flex method="post" justify-content-between" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row px-2 mx-2">
        {{-- <textarea class="form-control" id="message" name="message" placeholder="push massage (shift + Enter)"aria-label="With textarea"onkeydown="if(event.shiftKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea> --}}
          <input type="text" id = "message" name="message" >
        </div>
        <div class="py-2 form-group row mx-2">
          <label class="m-2">
             <span class="btn btn-primary">
               ファイルを選択
               <input type="file" class="form-control-file" id="image" name="image" style="display:none">
             </span>
          </label>
        </div>
        <div class="form-group row float-right m-2">
          <input type="hidden" name="community_id" value={{ $community->id }}>
          {{-- <button type="button" id="send" onclick="sendform();">送信する</button> --}}
          <input type="button" id="send" onclick="sendform();" class="btn btn-primary" value="送信する">
          {{-- <input type="submit" id = "submit" class="btn btn-primary submit" value="送信する"> --}}
          {{-- <button type="submit" onclick="send();">送信する</button> --}}
        </div>
    </form>
<script>
$(function () {
  sendform();
});

function sendform() {
  // フォームデータを取得
  var formdata = new FormData($('#message_form').get(0)); // POSTでアップロード
  $('#message_form')[0].reset();
  for (let value of formdata.entries()) {
    console.log(value);
}
  $.ajax({
    url: "/user/community/message/sendC",
    type: "POST",
    data: formdata,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "html"
  }).done(function (data, textStatus, jqXHR) {
    get_messageC();
  }).fail(function (jqXHR, textStatus, errorThrown) {
    alert("fail");
  });
}
</script>
@endsection
