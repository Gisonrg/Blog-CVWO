<?php
//this is the blog post related file
require_once("model/db.php");

//write an post
function write_post($title,$date, $author, $content) {
    $db = connect_db();
    $result = insert_post($db, $title,$date, $author, $content);
    if ($result) {
        $msg = "You have just posted a new blog post!";
        display_success($msg);
    } else {
        $msg = "Sorry, we have currently met some problem!\nPlease try again later.";
        display_failure($msg);
    }
    ?>
    <script language="javascript" type="text/javascript">
    setTimeout("javascript:location.href='index.php'", 3000); 
    </script>
    <?php
}

//edit an post
function edit_post($id, $title, $content){
    $db = connect_db();
    $result = update_post($db, $title, $content, $id);
    if ($result) {
        $msg = "Edit Successfully!";
        display_success($msg);
    } else {
        $msg = "Sorry, we have currently met some problem!\nPlease try again later.";
        display_failure($msg);
    }
    ?>
    <script language="javascript" type="text/javascript">
    setTimeout("javascript:location.href='index.php'", 3000); 
    </script>
    <?php
}

//display a post
function display_post($title,$date, $author, $content, $id, $full = false) {
    echo "<div class=\"blog-post\" id=\"$id\">";
    if (strpos($_SERVER['PHP_SELF'], 'view.php' ) == false) {
        echo "<a href=\"view.php?id=".$id."\"> <h2 class=\"blog-post-title\">".$title."</h2></a>";
    } else {
        echo "<h2 class=\"blog-post-title\" style = \"color:black\">".$title."</h2>";
    }

    echo "<p class=\"blog-post-meta\">".$date." by <a href=\"#\">".$author."</a></p>";
    if (strlen($content)<=50 || $full) {
        echo nl2br($content);
    } else {
        echo substr($content, 0, 50);
        ?>
        <a href="view.php?id=<?php echo $id;?>">...See More</a>
        <?php
    }
        echo "<div class=\"blog-post-div\">";
        if (isset($_SESSION['valid_user'])) {
            if ($_SESSION['valid_user']==$author) {
            echo "<li><a href=\"delete.php?id=".$id."\">Delete</a></li>
                  <li><a href=\"edit.php?id=".$id."\">Edit</a></li>";
            }
        }
        echo "</div>";  //end of dividend line
    echo "</div>"; //end of display

}

/*
 * Display a comment under the view post page
 */
function display_comment($author, $date, $content, $comment_id, $post_author) {
    echo "<div class=\"comment-meta\">";
    echo $author;
    echo "<small class=\"comment-metadata\">".$date."</small>";
    echo "</div>";
    echo "<div class=\"comment-show\">";
    echo $content;
    echo "</div>";

    if (check_session()) {
        echo "<div style=\"text-align:right\">";
        echo "<div class=\"comment-div\"><span class=\"glyphicon glyphicon-repeat\"></span>Reply</div>";
        if ($_SESSION['valid_user']==$post_author || $_SESSION['valid_user']==$author) {
            echo "<div class=\"comment-div\"><span class=\"glyphicon glyphicon-remove\"></span><a href=\"javascript:void(0)\" id=\"del\" name=\"".$comment_id."\">Delete</a></div>";
        }
        echo "</div>";
    }
    
    
}

//display an successful message
function display_success($msg) {
    ?>
    <div class="alert alert-success" style="text-align:center">
      <img src="view/pic/right.gif"/>
      <h2 style="color:#3c763d">Success!</h2>
    <?
        echo "<p>".$msg."</p>";
    ?>
    </div>
    <?php
}

//display an error message
function display_failure($msg) {
    ?>
    <div class="alert alert-danger" style="text-align:center">
      <img src="view/pic/error.gif"/>
      <h2 style="color:#a94442">Oops!</h2>
    <?
        echo "<p>".$msg."</p>";
    ?>
    </div>
    <?php
}



?>