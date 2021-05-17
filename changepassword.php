

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>change password</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .error
        {
             color: red;
        }
        body
        { 
            background: #1690A7;
            align-items: center;
            font: 25px sans-serif; 
        }
        h2
        {
            margin-bottom: 40px;
            color: black;
        }
        form
        {
            width: 500px;
            border:2px solid #ccc;
            padding: 30px;
            background:white;
            border-radius: 15px;
        }
    
    </style>
</head>


<?php
include 'connect.php';


if(isset($_POST['submit'])) 
{
   
    session_start();
    $emaillogin=$_SESSION['email'];
/*    $emaillogin=$_POST['email_login'];*/
    $newpassword=$_POST['newpassword'];
    $newpassword1=$_POST['newpassword1'];
    /*$id = $_SESSION['id'];*/
    $_SESSION['email']=$emaillogin;



$sql = "UPDATE crud_table SET password='$newpassword' where email='$emaillogin'";
           $results=mysqli_query($con, $sql);

    /*$sql="select * from  crud_table WHERE email='$emaillogin'";    
      $results = mysqli_query($con, $sql);*/

             if (($results) > 0) 
            {
                $newpassword = md5($newpassword);
                $_SESSION['success'] = "You changed your password";
                header('location: loginn.php?message="Sucessfully password updated"');
            }else {
               echo "New password dont match! ";  
            
        }
    }


    

?>









<script>
function validateForm() 
{
  var npass = document.forms["submit"]["newpassword"].value;
  var passd = document.forms["submit"]["newpassword1"].value;
  if (npass == "") 
  {
    alert("please Enter new password");
    return false;
  }
  if (passd ="npass")
   {
    alert("Your password is change");
    return true;
  }
  return false;
}
</script>
 


<body>
    
    
    <div class="wrapper" style="max-width:500px;margin:auto;"><br><br>
        <h1 align="center">Change password</h1><br><br>
       
        <form action="" method="POST" name="submit" onsubmit="return validateForm()">
 <!--           <?php
                error_reporting(E_ERROR | E_WARNING | E_PARSE);
                    $nofound = $_GET['Message'];
                    echo "<div style=\"color: red !important;\">$nofound</div>";
            
            ?>  -->   
          <!--   <div class="form-group">
                <label>Username</label><br>
                <input type="text" name="email_login" class="form-control" placeholder="email" value="" ><br>
                <span class="help-block"></span>
            </div>   -->  
            <div class="form-group">
                <label>Enter New password</label><br>
                <input type="password" name="newpassword" class="form-control" placeholder="password" >
                <span class="help-block"></span>
            </div>


             <div class="form-group">
                <label>Confirm New password</label><br>
                <input type="password" name="newpassword1" class="form-control" placeholder="confirm New password" >
                <span class="help-block"></span>
            </div>
            <div class="form-group"><br>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>

                   
        </form>
    </div>
       
</body>


</html>