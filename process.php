<?php
session_start();
require('model/model.php');

//this is a file for processing jquery.ajax request.
//it will check the $_POST['action'] variable for the action,
//then do the work accordingly.

if ($_POST['action']=='check_name') {
	$username = $_POST['username']; 
	$result = check_username($username);

} else if ($_POST['action']=='new_user') {
	$username = $_POST['username']; 
	$password = $_POST['password']; 
	$_SESSION['valid_user'] = $username;
	create_user($username, $password);
	$result = true;

} else if ($_POST['action']=='post_comment') {
	$postid = $_POST['postid']; 
	$content = $_POST['content']; 
	if (isset($_SESSION['valid_user'])) {
		$author = $_SESSION['valid_user'];
	} else {
		$author = "Somebody";
	}
	if (add_comment($postid, $author, $content)) {
		$result = true;
	} else {
		$result = false;
	}	

} else if ($_POST['action']=='delete_comment') {
	$comment_id = $_POST['comment_id']; 
	if (delete_comment($comment_id)) {
		$result = true;	
	} else {
		$result = false;		
	}
}

//callback
// return 0 or 1 for jquery do the callback reaction
if($result) {
		$arr['success'] = 1; 
} else {
		$arr['success'] = 0; 
}
// return in json format
echo json_encode($arr);

?>