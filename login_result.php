<?php
session_start();
$page_title = "Login";
require('view/home.php');
require('model/model.php');
$head = new Header();
$nav = new Nav();
$bloghead = new BlogHead();
$sidebar = new SideBar();

$page = new Home();
$page->DisplayTop($page_title, $head, $nav, false);


$name = $_POST['name'];
$password = $_POST['password'];

$page->DisplayPager();

//if login successfully or have already logged in.
if (check_session()) {
	echo "You have already logged in as ".$_SESSION['valid_user']."!";
} else {
	authenticate($name, $password);
}




$page->DisplayFooter();



?>