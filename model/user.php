<?php

//check the session to see if anyone has logged in
function check_session() {
	if (isset($_SESSION['valid_user'])){
		return true;
	} else {
		return false;
	}
}





?>