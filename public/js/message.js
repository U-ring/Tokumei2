$(function() {
   get_message();
});

function get_message() {
  $.ajax({
    url: "/result/ajax/",
    dataType: "json",
    
    success: data => {
      $("#comment-data")
          .find(".comment-visible")
          .remove();
          
      for (var i = 0; i < data.messages.length; i++) {
         var html = `
                    
                    <div class="media message-visible">
                      <div class="media-body">
                        <div class="row">
                           <span class="message-body-user">${data.messages[i].name}</span>
                           <span class="message-body-time">${data.messages[i].created_at}</span>
                        </div>
                        <span class="message-body-content">${data.messages[i].message}</span>
                      </div>
                    </div>
                    
                    `;
        $("#comment-data").append(html);
      }
    },
    
    error: () => {
       alert("ajax Error");
    }
  });
  
  setTimeout("get_message()",5000);
}