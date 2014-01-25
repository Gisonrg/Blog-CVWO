$(document).ready(function() {
  $("#btn").click(function() {
    var content = $('#comment_content').val();
    var postid = $('.blog-post').attr('id');
    $.ajax({
      type: "POST",
      url: 'process.php',
      dataType: "json",
      data: {
        "action": 'post_comment',
        "postid": postid,
        "content": content
      },
      success: function(json) {
        if (json.success == 1) {
          location.reload();
        } else {
          //display an error
        }
      }
    });
  });
  $("a#del").click(function() {
    var comment_id = $(this).attr('name');
    var r = confirm("Are you sure to delete this comment?");
    if (r) { 
      $.ajax({
      type: "POST",
      url: 'process.php',
      dataType: "json",
      data: {
        "action": 'delete_comment',
        "comment_id": comment_id
      },
      success: function(json) {
        if (json.success == 1) {
          alert("Success!");
          location.reload();
        } else {
          //display an error
          alert("Unknown Error!");
        }
      }
    });
    }
  });
});
