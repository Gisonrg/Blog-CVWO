<form method="post" action="add_result.php" class="form-horizontal" role="form">
  <div class="form-group">
    <label for="inputTitle" class="col-sm-1 control-label">Title</label>
    <div class="col-sm-11">
      <input type="title" name="title" class="form-control" id="inputTitl" placeholder="Title" required="">
    </div>
  </div>
  <textarea class="form-control" name="content" rows="15"></textarea>
  <br/>
  <div class="col-sm-4 col-sm-offset-4">
  <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Post</button>
  </div>
</form>

