<?php
session_start();
//the page title
$page_title = "Simple's Blog";
//include the file
require('view/home.php');
require('model/model.php');
//create new structure object
$head = new Header();
$nav = new Nav();
$bloghead = new BlogHead();
$sidebar = new SideBar();

//using structure objects to display the whole page
$page = new Home();

$page->DisplayTop($page_title, $head, $nav, $bloghead);

/*
 *  Pagination & Display
 */
//check if there is any post
//if yes then go display
//else show none.
$total = check_post();
if ($total != false) {
	//first, check if url contains the page variable (by default page = 1, the index)
	if (isset($_GET['page'])) {
		$current_page = (int)($_GET['page']);
	} else {
		$current_page = 1;
	}
	//second, how many post to show in one page. By default 10.
	$page_size = PAGESIZE;
	//now pass the parameter to the function
	$page->DisplayBlogContent($total, $current_page, $page_size);
	// //set the button, $previous page number, $next page number
	if ($total % $page_size==0) {
		$max_page = $total / $page_size;
	} else {
		$max_page = (int)($total / $page_size) + 1;
	}
	$page->DisplayPager(true, $current_page - 1, $current_page + 1, $max_page);
} else {
	$page->DisplayBlogContent();
	$page->DisplayPager(false);
}

//check the login status and display the correct sidebar
if (check_session()) {
	$page->DisplaySide($sidebar, true);
} else {
	$page->DisplaySide($sidebar);
}
//display footer
$page->DisplayFooter();
?>