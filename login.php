<?php
session_start();
$page_title = "Login";
require('view/home.php');

$head = new Header();
$nav = new Nav();
$bloghead = new BlogHead();
$sidebar = new SideBar();

$page = new Home();
$page->DisplayTop($page_title, $head, $nav, false);
$page->DisplayPager();

require('view/login.inc');

// $page->DisplaySide($sidebar);
$page->DisplayFooter();



?>