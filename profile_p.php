<?php
session_start();
 error_reporting(E_ERROR | E_WARNING | E_PARSE);
$user=$_SESSION['email'];
?>
<!DOCTYPE html>


<?php

 include "connect.php";

 $sql="SELECT * FROM crud_table where email='$user'";
 $result=mysqli_query($con,$sql);
 if ($result->num_rows > 0)
	{
	while($q = mysqli_fetch_array($result))
	{
       
		$login_username=$q['username'];
		$login_email=$q['email'];
		$login_address=$q['Address'];
		$login_DOB=$q['DOB'];
		$login_mobileno=$q['Mobile_no'];
		$login_city=$q['city'];
		$login_gender=$q['Gender'];
		$login_hobbie=$q['Hobbies'];
		
		



	}
}


 ?>
<html>

<head>
	<meta charset="UTF-8">
	<title>Profile Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
    <style>
    th {
         height: 70px;
        }
    table {
        
        border: 5px solid black;
         }
         td {
            text-align: center;
            }
    body
        { 
            background: #1690A7;
            align-items: center;
            font: 20px sans-serif; 
        }
    h2
        {
            margin-bottom: 40px;
            color: black;
        }
    #div1
        {
            width: 500px;
            border:2px solid #ccc;
            padding:12px;
            background:white;
            
        }
    </style>
</head>
<?php
if($user==TRUE)
{

} 
else
{
    header("Location:http://localhost/crud demo/loginn.php");   
}
?>
<body>
<!-- 
	<h1>Wellcome</h1> -->

     <ul class="breadcrumb">
  	<li><a href="./profile_p.php">HOME</a></li>
  
  	<li><a href="./logout.php">Logout</a></li>

    <li><a href="./changepassword.php"> Change Password</a></li>

	</ul>
	<div class="wrapper" style="max-width:500px;margin:auto;"><br><br>
	<h1 align="center">INFORMATION OF USER</h1><br><br>
	<div id="div1">
        <label>username :</label><?php echo "$login_username"?>
    </div><br>

    <div id="div1">
        <label>email :</label><?php echo "$login_email"?> 
            
    </div><br>
    <div id="div1">
        <label>Address :</label><?php echo "$login_address"?> 
            
    </div><br>

    <div id="div1">
        <label>DOB :</label><?php echo "$login_DOB"?> 
            
    </div><br>


    <div id="div1">
        <label>mibile no :</label><?php echo "$login_mobileno"?>  
          
    </div><br>
    <div id="div1">
        <label>city :</label><?php echo "$login_city"?>    
        
    </div><br>
    <div  id="div1">
        <label>gender :</label> <?php echo "$login_gender"?> 

    </div><br>
    <div  id="div1">
        <label>hobbie :</label><?php echo "$login_hobbie"?> 
    </div>

	</div>

</body>
</html>