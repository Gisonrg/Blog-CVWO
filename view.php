<?php
session_start();
require('view/home.php');
require('model/model.php');

if (isset($_GET['id'])) {  
    $row = select_post($_GET['id']);
} else {  
    $msg = "Invalid Operaion!";
    display_failure($msg); 
    exit;
}  

$page_title = $row['title'];


$head = new Header();
$nav = new Nav();
$bloghead = new BlogHead();
$sidebar = new SideBar();
$page = new Home();
$page->DisplayTop($page_title, $head, $nav, $bloghead);
?>

<script type="text/javascript">
	
$(document).ready(function() {
	$("#btn").click(function() {
		var content = $('#comment_content').val();
		$.ajax({
			type: "POST",
			url: 'process.php',
			dataType: "json",
			data: {
				"action": 'post_comment',
				"postid": <?php echo $_GET['id']; ?>,
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

</script>


<?php



//display a post
display_post($row['title'],$row['date'], $row['author'], $row['content'], $row['postid'], true);

$page->DisplayComments($_GET['id'], $row['author']);
//display the form for comment
$page->DisplayCommentArea();
$page->DisplayPager();
if (check_session()) {
	$page->DisplaySide($sidebar, true);
} else {
	$page->DisplaySide($sidebar);
}
$page->DisplayFooter();
?>