<?php
session_start();
require('view/home.php');
require('model/model.php');



$page_title = "Deleting...";


$head = new Header();
$nav = new Nav();
$bloghead = new BlogHead();
$sidebar = new SideBar();

$page = new Home();
$page->DisplayTop($page_title, $head, $nav, $bloghead);

if (isset($_GET['id'])) {  
    $row = select_post($_GET['id']);
    delete_post($_GET['id']);
} else {  
	$msg = "Invalid Operaion!";
    display_failure($msg);
}  

?>
<script language="javascript" type="text/javascript">
setTimeout("javascript:location.href='index.php'", 3000); 
</script>
<?php
$page->DisplayPager();
if (check_session()) {
	$page->DisplaySide($sidebar, true);
} else {
	$page->DisplaySide($sidebar);
}
$page->DisplayFooter();
?>