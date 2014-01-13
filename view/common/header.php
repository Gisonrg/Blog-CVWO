<?php
require_once("config/config.php");

//common header
class Header {
	public $title = "Simple's Blog";
	public $font = "utf-8";


	public function display_header_misc() {
		echo "<meta charset=\"".$this->font."\">";
		?>
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="description" content="">
    	<meta name="author" content="">
    <?php
	}

	public function display_title($title) {
		echo "<title>".$title."</title>";
	}

	public function display_css() {
		
		echo"<link href=\"".CSS_PATH."/bootstrap.css\" rel = \"stylesheet\">";
		echo"<link href=\"".CSS_PATH."/blog.css\" rel = \"stylesheet\">";
		echo"<link href=\"".CSS_PATH."/signin.css\" rel = \"stylesheet\">";
	
	}

	public function DisplayTitle($title) {
		echo "<!DOCTYPE html>\n";
		echo "<html>\n";
  		echo "<head>\n";
  		$this->display_header_misc();
  		$this->display_title($title);
  		$this->display_css();
  		?>
  		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300' rel='stylesheet' type='text/css'>
		<link rel="icon" href="view/pic/favicon.ico" mce_href="view/pic/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="view/pic/favicon.ico" mce_href="view/pic/favicon.ico" type="image/x-icon">
		<!-- Bootstrap core JavaScript
	    ================================================== -->
		<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
  		<?php
  		echo "</head>";
	}
}


//common navigation bar
class Nav {

	public $tabs = array("Home"   => "index.php", 
                        "Archives"  => "arch.php", 
                        "About" => "about.php",
                       );
	//  "Login"=>"login.php"
	public function __set($name, $value) {
    	$this->$name = $value;
  	}
  	
	public function IsURLCurrentPage($url) {
		//this is not the current page
		if(strpos($_SERVER['PHP_SELF'], $url ) == false) {
			return false;
		} else {
		//this is the current page
			return true;
		}
	}

	public function display_navbar() {
	?>
		<div class="blog-masthead">
			<div class="container">
				<nav class="blog-nav">
	<?php
					reset($this->tabs);
					while (list($name, $url) = each($this->tabs)) {
						$this -> display_each_tab($name, $url, 
							$this->IsURLCurrentPage($url));
					}
	?>
				<!-- <a class="blog-nav-item blog-nav-login" href="view/login.php">Login</a> -->
				</nav>
			</div>
		</div>
	<?php
	}
	public function display_each_tab($name, $url, $active = true) {
		//if it is the current page, using 'blog-nav-item active'
		if ($active) {
			echo "<a class=\"blog-nav-item active\" href=\"".$url."\">".$name."</a>";
		} else {
			echo "<a class=\"blog-nav-item\" href=\"".$url."\">".$name."</a>";
		}
	}

}

//common blog head
class BlogHead {
	public $blog_name = BLOGNAME;
	public $blog_description = "A simple blog creating with Bootstrap.";
	public function DisplayBlogHead() {
		?>
		<div class="blog-header">
		<?php
		echo "<h1 class=\"blog-title\">".$this->blog_name."</h1>";
		echo "<p class=\"lead blog-description\">".$this->blog_description."</p>";
	}
	
}





?>