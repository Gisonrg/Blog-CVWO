<?php
session_start();
$page_title = "Logging out...";
require('view/home.php');
require('model/model.php');

$head = new Header();
$nav = new Nav();
$bloghead = new BlogHead();
$sidebar = new SideBar();

$page = new Home();
$page->DisplayTop($page_title,$head, $nav, false);
$page->DisplayPager();

check_logout();

$page->DisplayFooter();
?>