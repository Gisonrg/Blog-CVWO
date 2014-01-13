<?php
session_start();

$page_title = "About";

require('view/home.php');
require('model/model.php');
$head = new Header();
$nav = new Nav();
$bloghead = new BlogHead();
$sidebar = new SideBar();

$page = new Home();
$page->DisplayTop($page_title, $head, $nav, $bloghead);
?>

<img src="view/pic/coming_soon.png"/>
<p>This page is still under construction...</p>
<?php

$page->DisplayPager();
// if (check_session()) {
// 	$page->DisplaySide($sidebar, true);
// } else {
// 	$page->DisplaySide($sidebar);
// }
$page->DisplayFooter();
?>