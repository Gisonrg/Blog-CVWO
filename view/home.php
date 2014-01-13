<?php
require_once("config/config.php");
require_once(COMMON_PATH."header.php");
require_once(COMMON_PATH."sidebar.php");



//the basic page display class
//using true and false to control the display of an element
class Home {

	public function DisplayTop($title, $head=false, $nav=false, $bloghead=false) {
		if ($head != false) {
			$head->DisplayTitle($title);
		}
		

		?>
		<body>
		<?php
		if ($nav != false) {

			$nav->display_navbar();
		}
		?>
		<div class="container">
		<?php
		if ($bloghead != false ) {
			$bloghead ->DisplayBlogHead();
		}
		?>
		<div class="row">
		<div class="col-sm-8 blog-main">
		<?php
	}


	public function DisplayBlogContent($content = false, $page=1, $page_size=10) {
		if ($content==false) {
						// <!--Blog Post Area-->

						echo "Currently there are no posts yet. ";
						echo "<a href=\"add_post.php\">Create one now.</a>";


						// <!--Blog Post Area End-->	
		} else {
			//there is at least one post in the database
			//display it
			get_post($page, $page_size);
		}

	}

	public function DisplayComments($postid, $post_author) {
		echo "<div class=\"comment\" id=\"comment\">
				<p class=\"comment head\">Comment(s)</p>";
		
		get_comment($postid, $post_author);

		echo "</div>";
	}




	public function DisplayCommentArea() {
		if (check_session()) {
			echo "<div id=\"comment_area\">";
			echo "<h3>Post a Comment</h3>";
			echo "<textarea class=\"form-control\" id=\"comment_content\" rows=\"4\"></textarea>";
			echo "</div>";
			echo "<div id=\"btn\"><br/><button class=\"btn btn-primary\">Post</button></div>";
		} else {
			echo "<div style=\"text-align:center\">";
			echo "Please <a href=\"login.php\">sign in</a> to comment here.";
			echo "<p>New to here? <a href=\"register.php\">Register</a> now.</p></div>";
		}
	}


	//pager
	public function DisplayPager($show = false, $previous=0, $next=0, $max_page=0) {
		if ($show == true) {
			echo "<ul class=\"pager\">";
			if ($previous != 0) {
				echo "<li><a href=\"index.php?page=".$previous."\">Previous</a></li>";
			}
			if ($next <= $max_page) {
				echo "<li><a href=\"index.php?page=".$next."\">Next</a></li>";
			}
			echo "</ul>";
		} else {

		}
		?>
		</div><!-- /.blog-main -->
		<?php
	}


	//sidebar and footer
	public function DisplaySide($sidebar, $login=false) {
		$sidebar->DisplaySideBar($login);
	}
	
	public function DisplayFooter() {
		require('view/common/footer.php');
	}		
}



        

?>
