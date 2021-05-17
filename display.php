 <?php
include 'connect.php';


 $q="select * from crud_table";

 $query = mysqli_query($con,$q);


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
</head>
<body>

	<div class="container">
	<div class="col-lg-12">
		<h1 class=" text-warning text-center"> Dispaly table data</h1>

		<table class="table table-stripped table-hover  table-bordered">

			<?php
			
			 if ($_GET['message']!='') {
			 	echo $_GET ['message'];
			 }
				 
			?>
			<tr>
				
				<th> Id</th>
				<th> Username</th>
				<th> Password</th>
				<th>  email  </th>
				<th> Address</th>
				<th>  DOB    </th>
				<th> Mobile_no</th>
			    <th> Gender</th>
			    <th> Hobbies </th>
			    <th> country</th>
			    <th> state</th>
			    <th> city </th>
				<th> Delete</th>
				<th> Update</th>
			</tr>
<?php
			include 'connect.php';
			 $q="select * from crud_table";

			 $query = mysqli_query($con,$q);
			 while($res = mysqli_fetch_array($query)){

?>

	 <tr class="text-center">
	 <td> <?php echo $res['id'];  ?> </td>
	 <td> <?php echo $res['username'];  ?> </td>
	 <td> <?php echo $res['password'];  ?> </td>
	 <td> <?php echo $res['email'];  ?> </td>
	 <td> <?php echo $res['Address'];  ?> </td>
	 <td> <?php echo $res['DOB'];  ?> </td>
	  <td> <?php echo $res['Mobile_no'];  ?> </td>
	 <td> <?php echo $res['Gender'];  ?> </td>
	 <td> <?php echo $res['Hobbies'];  ?> </td>
	 <td> <?php echo $res['country'];  ?> </td>
     <td> <?php echo $res['state'];  ?> </td>
	 <td> <?php echo $res['city'];  ?> </td>

	 <td> <button class="btn-danger btn"> <a href="delete.php?id=<?php echo $res['id']; ?>" class="text-white"> Delete </a>  </button> </td>
	 <td> <button class="btn-primary btn"> <a href="update.php?id=<?php echo $res['id']; ?>" class="text-white"> Update </a> </button> </td>

	 </tr>
	 <?php
	}
	?>

			
					</table>

				
	</div>
	</div>

</body>
</html>