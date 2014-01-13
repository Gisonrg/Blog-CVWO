<?php


//common side bar
class SideBar {
    public $about_content = "<p>This is a simple blog made by 
                            <Strong>Jiang Sheng</strong> 
                            with <a href=\"http://getbootstrap.com\">Bootstrap</a>.</p>";
    public $archive_item = array();
    public $link_item = array("GitHub" => "https://github.com");

    //check login status
    //display accordingly
    public function display_login($loginin) {
    ?>
        <div class="sidebar-module sidebar-module-inset">
    <?php
    if ($loginin == false) {
        echo "<h4>Welcome!</h4>";
        // echo "<p>Please  <a href=\"login.php\">sign in</a></p>";
        // echo "<p>or Register</p>"
        ?>
        <a type="button" href="login.php" class="btn btn-primary btn-lg btn-block">Sign in</a>
        <a type="button" href="register.php" class="btn btn-primary btn-lg btn-block">Register</a>
        <!-- <a role="button" href="login.php" class="btn btn-primary">Sign up</a></p> -->
        <?php
    } else {
        echo "<h4>Welcome!</h4>";
        echo "You have logged in as <strong>".$_SESSION['valid_user']."</strong>.";
        echo "<br/><ul>";
        echo "<li><a href=\"add_post.php\">New Post</a></li>";
        // echo "<br/>";
        echo "<li><a href=\"logout.php\">Logout</a></li>";
        echo "</ul>";
    }
    ?>
        </div>
    <?php
    }



    public function display_about() {
    ?>
        <div class="sidebar-module sidebar-module-inset">
    <?php
        echo "<h4>About</h4>";
        echo $this->about_content;
    ?>
        </div>
    <?php
    }

    public function display_module($head, $list_item) {
        echo "<div class=\"sidebar-module\">";
        echo "<h4>".$head."</h4>";
        ?>
        <ol class="list-unstyled">
        <?php
            while (list($name, $url) = each($list_item)) {
                echo "<li><a href=\"".$url."\">".$name."</a></li>";
            }
        ?>
        </ol>
        </div>
        <?php
    }

    public function DisplaySideBar($loginin = false) {
        ?>
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
        <?php
        $this->display_login($loginin);
        $this->display_about();
        $this->display_module('Archives',$this->archive_item);
        $this->display_module('Elsewhere',$this->link_item);
        ?>
        </div>
        <?php
    }
  }
?>