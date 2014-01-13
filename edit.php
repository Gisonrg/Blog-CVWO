<?php
session_start();
require('view/home.php');
require('model/model.php');

if (isset($_GET['id'])) {  
    $row = select_post($_GET['id']);
} else {  
    $msg = "Invalid Operaion!";
    display_failure($msg); 
}  

$page_title = "Edit - ".$row['title'];
$id = $_GET['id'];

$head = new Header();
$nav = new Nav();
$bloghead = new BlogHead();
$sidebar = new SideBar();

$page = new Home();
$page->DisplayTop($page_title, $head, $nav, $bloghead);



echo "<form method=\"post\" action=\"update.php?id=".$_GET['id']."\" class=\"form-horizontal\" role=\"form\">";
?>
  <div class="form-group">
    <label for="inputTitle" class="col-sm-1 control-label">Title</label>
    <div class="col-sm-11">
      <input type="title" name="title" class="form-control" id="inputTitl" value="<?php echo $row['title'];?>" placeholder="Title" required="">
    </div>
  </div>
  <textarea class="form-control" name="content" rows="18"><?php echo $row['content'];?></textarea>
  <br/>
  <div class="col-sm-4 col-sm-offset-4">
  <button class="btn btn-lg btn-primary btn-block" name="update" type="submit">Update</button>
  <!-- <a href="view.php?id=">...See More</a></p> -->
  <!-- <a role="button" href="login.php" type="submit" class="btn btn-lg btn-primary btn-block" name="update">Update</a> -->
  </div>
</form>

<?php
$page->DisplayPager();
if (check_session()) {
	$page->DisplaySide($sidebar, true);
} else {
	$page->DisplaySide($sidebar);
}
$page->DisplayFooter();
?>