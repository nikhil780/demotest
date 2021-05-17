<?php 
include 'connect.php';
$id = $_GET['id'];

$qry = mysqli_query($con,"select * from crud_table where id='$id'"); // select query$row = 
$data = mysqli_fetch_array($qry); // fetch data
$check=$data["Hobbies"]; 
$checked=explode(',',$check);


 if(isset($_POST['done'])){


 $username =   $_POST['username'];
 $password =   $_POST['password'];
  $email =    $_POST['email'];
 $Address =    $_POST['Address'];
  $DOB =    $_POST['DOB'];
 $Mobile_no=   $_POST['Mobile_no'];
 $Gender    =  $_POST['Gender'];
 $Hobbies =    implode(",",$_POST["Hobbies"]);
 $country   =      $_POST['country'];
 $state   =      $_POST['state'];
 $city   =      $_POST['city'];

 $q = " update crud_table set id=$id, username='$username', password='$password' ,Address='$Address' ,Mobile_no='$Mobile_no', Gender='$Gender' ,Hobbies='$Hobbies', city='$city',DOB='$DOB',email='$email',country='$country', state='$state' where id=$id ";

 $query = mysqli_query($con,$q);

 header('location:display.php?message="updated sucessfully"');
 }

?>


<!DOCTYPE html>
<html>
<head>
  <title></title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js">
              </script> 
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js">
              </script>
</head>
<body>
     <div class="col-lg-6 m-auto">
       <form method="post" action="" name="register">
                
       <div class="card">

       <div class="card-header bg-dark">
       <h1 class="text-white"> Update Operation </h1>
  
       </div> 

        <label> Username:</label>
        <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>">  <br>

        <label> Password:</label>
        <input type="text" name="password" class="form-control" value="<?php echo $data['password']; ?>" >  <br>

        <label> email:</label>
        <input type="text" name="email" class="form-control" value="<?php echo $data['email']; ?>" >  <br>



        <label> DOB:</label>
        <input type="date" name="DOB" class="form-control" value="<?php echo $data['DOB']; ?>" >  <br>






        <tr>
                <td>Address</td>
                <td><textarea name = "Address" rows="5" cols= " 50"><?php echo $data['Address']; ?> </textarea></td>
            </tr>

    <label> Mobile_no: </label>
 <input type="text" name="Mobile_no" value="<?php echo $data['Mobile_no']; ?>" class="form-control"> <br><br>


 <tr>
                <div class="form-group">
                            <label>Hobbies</label><br>
                            <div id="Hobbies">
                                <input type="checksbox" name="Hobbies[]" value="Cricket">
                                <label>
                                <?php if(in_array("Cricket",$checked))
                        {
                            echo "checke";
                        }
                ?>Cricket</label><br>
                                <input type="checkbox" name="Hobbies[]" value="Tennis">
                                <label>
                                <?php if(in_array("Tennis",$checked))
                        {
                            echo "checked";
                        }
                ?>Tennis</label><br>
                                <input type="checkbox" name="Hobbies[]"  value="Football">
                                <label>
                               <?php if(in_array("Football",$checked))
                        {
                            echo "checked";
                        }
                ?> Football</label><br>
                                <input type="checkbox" name="Hobbies[]" value="Volleyball">
                                <label>
                                <?php if(in_array("Volleyball",$checked))
                        {
                            echo "checked";
                        }
                ?>Volleyball</label><br>
                            </div>
                        </div><br>

  <tr> 
                <label>Gender :</label>
                        <td><input  type="radio" name="Gender" value="male" 
                          <?php 
                    if($data["Gender"]=='male')
                    { 
                      echo "checked";
                    } 
                    ?>>male</td>
                        <td><input type="radio" name="Gender" value="Female" 
                          <?php 
                    if($data["Gender"]=='Female')
                    { 
                      echo "checked";
                    } 
                    ?>>Female</td>
                        <td><input type="radio" name="Gender" value="Others" 
                          <?php 
                    if($data["Gender"]=='Others')
                    { 
                      echo "checked";
                    } 
                    ?>>Others</td>
    
                </tr><br><br>

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
</div>
 <br>


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



        <button class="btn btn-success" type="submit" name="done"> submit </button>

        
      </form>

      
     </div>
</body>

<script src="register.js"></script>
</html>