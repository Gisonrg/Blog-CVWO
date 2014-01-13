<?php

require_once("model/db.php");
require_once("model/user.php");

//authenticate the user
function authenticate($name, $password) {
	$mysql = connect_db();
	check_user($mysql, $name, $password);
}

//log out
function check_logout() {
	if (isset($_SESSION['valid_user'])) {
		$old_user = $_SESSION['valid_user']; 
		unset($_SESSION['valid_user']); 
		session_destroy();
	?>
	<div class="alert alert-warning" style="text-align:center">
	<h2 style = "color: #8a6d3b">You have logged out.</h2>
	</div>
	<?php 
	} else {

		// if they weren’t logged in but came to this page somehow
	?>
		<div class="alert alert-danger" style="text-align:center">
		<h4 style="color:#a94442">You were not logged in, and so have not been logged out.</h4>
		</div>
	<?php
	}
	?>
	<script language="javascript" type="text/javascript">
        setTimeout("javascript:location.href='index.php'", 3000); 
     </script>
    <?php

}

?>