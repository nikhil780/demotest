<?php  

include 'connect.php';


if(isset($_POST['done'])){

 $username =   $_POST['username'];
 $password =   $_POST['password'];
  $email =     $_POST['email'];
 $Address=     $_POST['Address'];
  $DOB=     $_POST['DOB'];
 $Mobile_no=   $_POST['Mobile_no'];
 $Gender    =  $_POST['Gender'];
 $Hobbies =    implode(",",$_POST["Hobbies"]);
$country    =  $_POST['country'];
$state    =  $_POST['state'];
$city   =  $_POST['city'];
 
$duplicate=mysqli_query($con,"select * from crud_table where email='$email' ");
if (mysqli_num_rows($duplicate)>0)
  {
                    $Message = urlencode(" *This email aleready exist ");
                    header("Location:http://localhost/crud demo/Register.php?Message=$Message ");
                    
                }
                else
                {


 $q = " INSERT INTO `crud_table`(`username`, `password`, `Address`,`Mobile_no`,`Gender`,`Hobbies`,`country`,`state`,`city`,`email`,`DOB`) VALUES ( '$username', '$password' ,'$Address','$Mobile_no','$Gender' , '$Hobbies','$country','$state','$city','$email','$DOB')";

 $query = mysqli_query($con,$q);
 if($query>0)
 {
    header('location:display.php?message="Sucessfully User Created"');
 }
}
}



?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="UTF-8">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js">
              </script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js">
              </script> 
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js">
              </script>
<style type="text/css">
                  .error
                  {
                      color: red;
                  }
                
                  body
                  { 
                      background: #1690A7;
                      align-items: center;
                      font: 15px sans-serif; 
                  }
                  form
                  {
                      width: 500px;
                      border:2px solid #ccc;
                      padding: 30px;
                      background:white;
                      align-items: center;
                  }


              </style>
</head>
<body>
<div class="col-lg-6 m-auto">

 <div id="form-wrapper" class="form1" style="max-width:0px;margin:auto;"> 
 <form method="post" name="register">
 <!--  <?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
  $msggg=$_GET["Message"];
  echo "$msggg";

  ?> -->
  <div class="card-header bg-dark">
 <h1  align="center" class="text-white text-center">  Register Form </h1>
 </div><br>
 
 <br><br><div class="card">
 
 

 <label> Username: </label>
 <input type="text" name="username" class="form-control"> <br>

 <label> Password: </label>
 <input type="password" name="password" class="form-control"> <br>



    <div class="form-group">  
              <label for="email">
              Email :
            </label>
                    <input type="email" name="email"  id="email" class="form-control" placeholder= "email" value=""><br>
            <span class="help-block"></span>
          </div>



<tr>
                <td>Address :</td>
                <td><textarea name = "Address" rows="5" cols= " 50"></textarea></td>
            </tr>
            <br>
            <br>


            <label for="birthday">DOB:</label>
  <input type="date" id="birthday" name="DOB" >


  <br>
  <br>

    <label> Mobile_no: </label>
 <input type="text" name="Mobile_no" class="form-control"> <br><br>



<div class="form-group">
                            <label>Hobbies</label><br>
                            <div id="Hobbies">
                                <input type="checksbox" name="Hobbies[]" value="Cricket">
                                <label>Cricket</label><br>
                                <input type="checkbox" name="Hobbies[]" value="Tennis">
                                <label>Tennis</label><br>
                                <input type="checkbox" name="Hobbies[]"  value="Football">
                                <label>Football</label><br>
                                <input type="checkbox" name="Hobbies[]" value="Volleyball">
                                <label>Volleyball</label><br>
                            </div>
                        </div>

                <br><br>

   <div id="radio-error" class="radio-error">
                <label>Gender :</label>
                        <input  type="radio" name="Gender" value="male" >male
                        <input type="radio" name="Gender" value="Female">Female
                        <input type="radio" name="Gender" value="Others">Others
                      </div>  
                    </div>
               <br><br>
<div class="form-group">

<label for="country">Country</label>
<select class="form-control" name="country" id="country-dropdown">
<option value="">Select Country</option>
<?php
//require_once "db.php";
$result = mysqli_query($con,"SELECT * FROM countries");
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row['id'];?>"><?php echo $row["name"];?></option>
<?php
}
?>
</select>

<div class="form-group">
<label for="state">State</label>
<select class="form-control" name="state" id="state-dropdown">
</select>
</div>                        
<div class="form-group">
<label for="city">City</label>
<select class="form-control" name="city" id="city-dropdown">
</select>
</div>
</div>

 <br>

 <button class="btn btn-success" class="form-control" type="submit" name="done"> Submit </button><br>
</div>



<script>
$(document).ready(function() {
$('#country-dropdown').on('change', function() {
var country_id = this.value;
$.ajax({ 
url: "states-by-country.php",
type: "POST",
data: {
country_id: country_id
},
cache: false,
success: function(result){
$("#state-dropdown").html(result);
$('#city-dropdown').html('<option value="">Select State First</option>'); 
}
});
});    
$('#state-dropdown').on('change', function() {
var state_id = this.value;
$.ajax({
url: "cities-by-state.php",
type: "POST",
data: {  
state_id: state_id
},
cache: false,
success: function(result){
$("#city-dropdown").html(result);
}
});
});
});
</script>
    

 </div>
 </form>
</div >
 </div>
</body>
<script src="register.js"></script>


</html>