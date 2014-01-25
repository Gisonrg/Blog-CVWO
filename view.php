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

 <script src="static/js/comment.js"></script>



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