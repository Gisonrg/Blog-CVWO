 <script src="static/js/register.js"></script>

<form class="form-signin" method="post" id="form1" role="form">
  <h2 class="form-signin-heading">New User Register</h2>
  <span class="" id="f1">
  <label class="control-label" for="name">User Name</label>
  <input type="text" class="form-control" id="name" name="name" placeholder="User Name" required="" autofocus="">
  </span>
  <div id="msg1"></div>

  <span class="" id="f2">
  <label class="control-label" for="password">Password</label>
  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
  </span>
  <div id="msg2"></div>

  <span class="" id="f3">
  <label class="control-label" for="repassword">Re-enter Your Password</label>
  <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Re-enter Your Password" required="">
  <div id="msg3"></div>
  </span>

  </form>
  <div style="text-align:center" id="btn">
  <button class="btn btn-primary" id="submit" >Submit</button> 
   <button class="btn btn-danger" id="cancel" >Cancel</button> 
  </div>
  <div id ="callback"></div>




