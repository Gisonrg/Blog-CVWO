<?php
require_once("config/config.php");
require_once("view/blogpost.php");

//connect to the database using the defined setting.
function connect_db() {
	$mysql = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD,DB_NAME);
	if(!$mysql) {
      echo "Cannot connect to database.";
      exit;
    }
  return $mysql;
}

/*
 *  Post and database related function
 */

//insert a post into the database
function insert_post($mysql, $title, $date, $author, $content) {
  $query = "insert into posts values
          (NULL, \"".$title."\", \"".$date."\", \"".$author."\", \"".$content."\");";
  $result = mysqli_query($mysql, $query);
  if(!$result) {
      return false;
    } else {
      return true;
    }
}

//update an existing post in the database
function update_post($mysql, $title, $content, $id) {
  $query = "update posts
            set title = \"".$title."\",
            content = \"".$content."\"
            where postid = ".$id.";";
  $result = mysqli_query($mysql, $query);
  if(!$result) {
      return false;
    } else {
      return true;
    }
}

//get a post information from the database
function get_post($page, $page_size) {
  $current = ($page-1)*$page_size;
  $mysql=connect_db();
  $query = "select * from posts order by postid desc limit ".$current." , ".$page_size;
  $result = mysqli_query($mysql, $query);
  $row = mysqli_fetch_assoc($result);
  while ($row) {
    display_post($row['title'],$row['date'], $row['author'], $row['content'], $row['postid']);
    $row = mysqli_fetch_assoc($result);
  }
}

//select (search) one post in the database
//The true argument is the searching/selecting keyword
function select_post($id=false, $title= false, $author=false) {
  $mysql=connect_db();
  if ($id!=false) {
    $query = "select * from posts where postid =".$id.";";
    $result = mysqli_query($mysql, $query);
    $row = mysqli_fetch_assoc($result);
    // while ($row) {
    //   $row = mysqli_fetch_assoc($result);
    // }
    return $row;
  } elseif ($title != false) {
    $query = "select * from posts where title LIKE (\"%".$title."\"%);";
    $result = mysqli_query($mysql, $query);
    $row = mysqli_fetch_assoc($result);
    while ($row) {
      display_post($row['title'],$row['date'], $row['author'], $row['content'], $row['postid'], true);
      $row = mysqli_fetch_assoc($result);
    }
  } elseif ($author != false) {
    $query = "select * from posts where author LIKE (\"%".$author."\"%);";
    $result = mysqli_query($mysql, $query);
    $row = mysqli_fetch_assoc($result);
    while ($row) {
      display_post($row['title'],$row['date'], $row['author'], $row['content'], $row['postid'], true);
      $row = mysqli_fetch_assoc($result);
    }
  } else {
    //throw some exceptions.
    ;
  }
}

//check if a post exist
function check_post() {
  $mysql=connect_db();
  $query = "select count(*) from posts";
  $result = mysqli_query($mysql, $query);
  $row = mysqli_fetch_row($result);
  $count = $row[0];
  if ($count > 0) {
    return $count;
  } else {
    return false;
  }
}

//delete a post from the database
function delete_post($id) {
  $mysql=connect_db();
  $query = "delete from posts where postid =".$id.";";
  $result = mysqli_query($mysql, $query);
  if (!$result) {
    $msg = "We have currently met some problem!\nPlease try again later.";
    display_failure($msg);
  } else {
    $msg = "You have just deleted a blog post!";
    display_success($msg);
  }

}

/*
 *  Login and database related function
 */

//check the user with the database
//for log in usage
function check_user($mysql, $name, $password) {
	$query = "select count(*) from users where
				name = '".$name."' and
				password = sha1('".$password."')";
	$result = mysqli_query($mysql, $query);
    if(!$result) {
      echo "No result come back.\nPlease try later.";
      exit;
    }
    $row = mysqli_fetch_row($result);
    $count = $row[0];
    if ($count > 0) {
      // visitor's name and password combination are correct
      $_SESSION['valid_user'] = $name;
      
    ?>
      <div class="alert alert-success" style="text-align:center">
      <h1 style="color:#3c763d">Welcome!</h1>
    <?
      echo  "<p>You are now logged in as <strong>".$_SESSION['valid_user']."</strong>!</p>
            <p>You will now be redirected to the home page...</p>";
    
    ?>
    </div>
    
     <script language="javascript" type="text/javascript">
        setTimeout("javascript:location.href='index.php'", 4000); 
     </script>

    <?php
    } else {
    // visitor's name and password combination are not correct
    ?>
    <div class="alert alert-danger alert-dismissable" style="text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    Wrong Password or User Name, please try again.
    </div>
    

    <?php
    require('view/login.inc');
  }
}

/*
 *  Register and database related function
 */
function check_username($name) {
  $mysql=connect_db();
  $query = "select count(*) from users where
        name = '".$name."'";
  $result = mysqli_query($mysql, $query);
    if(!$result) {
      echo "No result come back.\nPlease try later.";
      exit;
    }
    $row = mysqli_fetch_row($result);
    $count = $row[0];
    if ($count > 0) {
      //the name cannot be used
      return false;
    } else {
      //the name can be use
      return true;
    }
}
//create new user
function create_user($name, $password) {
  $mysql=connect_db();
  $query = "insert into users values ('".$name."', sha1('".$password."'))";
  $result = mysqli_query($mysql, $query);
    if(!$result) {
      echo "No result come back.\nPlease try later.";
      return false;
    } else {
      return true;
    }
}

/*
 *  Comments and database related function
 */

//add a comment to the database
function add_comment($postid, $author, $content) {
  $mysql=connect_db();
  $query = "insert into comments values
          (NULL, ".$postid.", NULL, \"".$author."\", \"".$content."\");";
  $result = mysqli_query($mysql, $query);
  if(!$result) {
      return false;
    } else {
      return true;
    }
}

//get the comment of a post from database
function get_comment($postid, $post_author) {
  $mysql=connect_db();
  $query = "select * from comments where postid = ".$postid." order by date";
  $result = mysqli_query($mysql, $query);
  if(!$result) {
    return false;
  }
  $row = mysqli_fetch_assoc($result);
  while ($row) {
    display_comment($row['author'],$row['date'], $row['content'],$row['comment_id'], $post_author);
    $row = mysqli_fetch_assoc($result);
  }
}

//delete a comment from the database
function delete_comment($comment_id) {
  $mysql=connect_db();
  $query = "delete from comments where comment_id =".$comment_id.";";
  $result = mysqli_query($mysql, $query);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}


?>