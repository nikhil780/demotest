

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Forget password</title>
    
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
    $emaillogin=$_POST['email_login'];
    $newpassword=$_POST['newpassword'];
    /*$id = $_SESSION['id'];*/
    $_SESSION['email']=$emaillogin;





    $sql="select * from  crud_table WHERE email='$emaillogin'";    
      $results = mysqli_query($con, $sql);

            if (mysqli_num_rows($results) == 1) {

                $newpassword = md5($newpassword);
                $sql = "UPDATE crud_table SET password='$newpassword' where email='$emaillogin'";
                mysqli_query($con, $sql);

                $_SESSION['email_login'] = $emaillogin;
                $_SESSION['success'] = "You changed your password";
                header('location: loginn.php?message="Sucessfully password updated"');
            }else {
               echo "Wrong Username ";  
            
        }
    }


    

?>
<script>
function validateForm() 
{
  var usern = document.forms["submit"]["email_login"].value;
  var passd = document.forms["submit"]["newpassword"].value;
  if (usern == "") 
  {
    alert("Username must be filled out");
    return false;
  }
  if (passd == "")
   {
    alert("Password must be filled out");
    return false;
  }
  return true;
}
</script>
 


<body>
    
    
    <div class="wrapper" style="max-width:500px;margin:auto;"><br><br>
        <h1 align="center">Forget password</h1><br><br>
       
        <form action="" method="POST" name="submit" onsubmit="return validateForm()">
 <!--           <?php
                error_reporting(E_ERROR | E_WARNING | E_PARSE);
                    $nofound = $_GET['Message'];
                    echo "<div style=\"color: red !important;\">$nofound</div>";
            
            ?>  -->   
            <div class="form-group">
                <label>Username</label><br>
                <input type="text" name="email_login" class="form-control" placeholder="email" value="" ><br>
                <span class="help-block"></span>
            </div>    
            <div class="form-group">
                <label>Enter New password</label><br>
                <input type="password" name="newpassword" class="form-control" placeholder="password" >
                <span class="help-block"></span>
            </div>
            <div class="form-group"><br>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>

                   
        </form>
    </div>
       
</body>


</html>