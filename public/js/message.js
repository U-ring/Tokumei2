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
                           <span class="message-body-time">${data.messages[i].created_at}</span>
                        </div>
                      </div>
                      <span class="message-body-content">${data.messages[i].message}</span>
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