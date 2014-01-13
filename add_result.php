<?php
session_start();

$title = trim($_POST['title']);
if(!get_magic_quotes_gpc())
{
    $content = addslashes(trim($_POST['content']));
} else {
	$content = trim($_POST['content']);
}
$content=nl2br($content);
$author = $_SESSION['valid_user'];
$date = date("F jS\, Y");

$page_title = "New Post";

require('view/home.php');
require('model/model.php');
require_once('view/blogpost.php');
$head = new Header();
$nav = new Nav();
$bloghead = new BlogHead();
$sidebar = new SideBar();

$page = new Home();
$page->DisplayTop($page_title, $head, $nav, $bloghead);

?>
<div class="col-sm-12">
<?php
//store the post into the database
write_post($title, $date, $author, $content);
?>

</div>
<?php
$page->DisplayPager();
if (check_session()) {
	$page->DisplaySide($sidebar, true);
} else {
	$page->DisplaySide($sidebar);
}
$page->DisplayFooter();
?>