$('#message_form').submit(function(event) {
// HTMLでの送信をキャンセル
event.preventDefault();
let $image = $('input[name="image"]');
var $form = $(this);
var $button = $form.find('.submit');
var formdata = new FormData($('#message_form').get(0));
formdata.append("image", $image.prop('files')[0]);
console.log(formdata.get('image'));
console.log($form.serialize());
console.log(formdata);
$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
url: "/user/group/message/sendC",
type: "POST",
dataType: "html",
processData: false,
data: $form.serialize(),
    formdata,
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
