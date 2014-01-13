<script type="text/javascript">
    $(document).ready(function() {
      //check if the name is valid or already exist
      $("#name").focus(function() {
         $("#msg1").html('');
      });
      $("#name").change(function() {

        var reName = /^\w+$/;
        var username = $('#name').val();
        if (!reName.test(username)) {
          //the name is invalid
          $("#msg1").html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Oops!</strong> Please use a valid username.</div>');
        } else {
          $.ajax({
            type: "POST",
            url: 'process.php',
            dataType: "json",
            data: {
              "action": 'check_name',
              "username": username
            },
            success: function(json) {
              if (json.success == 1) {
                $('#f1').attr("class","has-success");
              } else {
                $('#f1').attr("class","has-error");
                $("#msg1").html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Oops!</strong> Please change a username.</div>');
              }
            }
          });
        }
      });
      //check the password. The password can only be char, number, and underscore '_'
      //the length should between 4-18
      $("#password").focus(function() {
         $("#msg2").html('');
      });
      $("#password").change(function() {
        var rePsd = /^[A-Za-z0-9]\w{3,17}$/;
        var psd = $('#password').val();
        if (!rePsd.test(psd)) {
          $('#f2').attr("class","has-error");
          $("#msg2").html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Oops!</strong> Please check your password format.</div>');
        }  else {
          $('#f2').attr("class","has-success");
        }
      });
      $("#repassword").focus(function() {
         $("#msg3").html('');
      });
      //check if re-enter password is the same as the password
      $("#repassword").change(function() {
        var psd1 = $('#password').val(); 
        var psd2 = $('#repassword').val();
        if (psd1 == psd2) {
          $('#f3').attr("class","has-success");
        } else {
          $('#f3').attr("class","has-error");
          $("#msg3").html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Oops!</strong> Please make sure you have entered the same password.</div>');
        }
      });
      //submit the form
      $("#submit").click(function() {
        var reName = /^\w+$/;
        var rePsd = /^[A-Za-z0-9]\w{3,17}$/;
        var username = $('#name').val();
        var password = $('#password').val();
        var repassword = $('#repassword').val();
        if (reName.test(username) && rePsd.test(password) && (password == repassword)) {
          $.ajax({
            type: "POST",
            url: 'process.php',
            dataType: "json",
            data: {
              "action": 'new_user',
              "username": username,
              "password": password
            },
            success: function(json) {
              if (json.success == 1) {
                $("#form1").remove();
                $("#btn").remove();
                $("#callback").html("<div class='alert alert-success' style='text-align:center'><h1 style='color:#3c763d'>Register Success!</h1><p>You are now logged in as <strong> "+username+" </strong>!</p><p>You will now be redirected to the home page...</p></div>");
               setTimeout("javascript:location.href='index.php'", 5000); 
 
              } else {
                //display an error
              }
            }
          });
        } else {
          $("#msg3").html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Oops!</strong> Invalid username or password.</div>');
        }
      });
      //empty each field
      $("#cancel").click(function() {
        $('input').val('');
      });
    });


</script>

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
  <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Password" required="">
  <div id="msg3"></div>
  </span>

  </form>
  <div style="text-align:center" id="btn">
  <button class="btn btn-primary" id="submit" >Submit</button> 
   <button class="btn btn-danger" id="cancel" >Cancel</button> 
  </div>
  <div id ="callback"></div>




