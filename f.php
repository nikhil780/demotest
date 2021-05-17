
<?php
session_start();
/*$id=$_SESSION['profile_id'];*/

include "connect.php";
$q=mysqli_query($con,"SELECT password from crud_table where id='$id' ");
$iddd= mysqli_fetch_array($q);


if(!empty('submit'))
{

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js">
              </script> 
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js">
              	 </script>
</head>
<body>
	<div class="wrapper" style="max-width:500px;margin:auto;"><br><br>
        <h1 align="center">CHANGE PASSWORD</h1><br><br>
        <form action="" method="post" name="changepass" onsubmit="return validateForm()">
            <div class="form-group">
                <label>New Password</label><br>
                <input type="password" name="newpass" class="form-control" placeholder="new password" value="" ><br>
                <span class="help-block"></span>
            </div>    
            <div class="form-group">
                <label>Confirm New Password</label><br>
                <input type="password" name="cpass" class="form-control" placeholder="confirm New password" >
                <span class="help-block"></span>
            </div>
            <div class="form-group"><br>
                <input type="submit" class="btn btn-primary" value="Change Password">
            </div>
        </form>
    </div>
    <script>
    	$(document).ready(function ()
    	{

    		jQuery.validator.addMethod("passonly", function(value, element)
    	{
        	return this.optional(element) || /^(?!\s)(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]+$/i.test(value);
        	});
        	$('#changepass').validate(
    {
      rules: 
      {
        newpass: 
        {
          required: true,
          minlength: 8,
          passonly:true
        },
        cpass: 
        {
          required: true,
          equalTo: "#newpass"
        }

      },
      messages: 
      {
        
        newpass: 
        {
          required: 'Please enter Password.',
          minlength: 'Password must be at least 8 characters long.',
          passonly: 'enter a valid password'
        },
        cpass: 
        {
          required: 'Please enter Confirm Password.',
          equalTo: 'Confirm Password do not match with Password.',
        }
        
      }
        	
     });
  });
    	
          
      </script>

</body>
</html>