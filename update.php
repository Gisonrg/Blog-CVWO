<?php
session_start();

if (isset($_GET['id'])) {  
	$id = $_GET['id'];
    $title = trim($_POST['title']);
	$content = addslashes(trim($_POST['content']));
} else {  
    $msg = "Invalid Operaion!";
    display_failure($msg); 
}

$page_title = "Updating...";

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
//save the update and update it to the database
edit_post($id, $title, $content);
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