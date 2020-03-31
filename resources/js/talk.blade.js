$(function() {
 sendform();
});
function sendform()
{
    // フォームデータを取得
    var formdata = new FormData($('#message_form').get(0));
    // POSTでアップロード
    $.ajax({
        url  : "/user/group/message/sendC",
        type : "POST",
        data : formdata,
        cache       : false,
        contentType : false,
        processData : false,
        dataType    : "html"
    })
    .done(function(data, textStatus, jqXHR){
        get_message();
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        alert("fail");
    });
}
