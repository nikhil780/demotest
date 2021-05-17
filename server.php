<?php
	session_start();

	// variable declaration
	$username = "";
	$errors = array();
	$_SESSION['success'] = "";

	// connect to database
	$con = mysqli_connect('localhost', 'root', '', 'crud_op');
	
// FORGOT Password
	if (isset($_POST['forget_user'])) {
		$school_name = mysqli_real_escape_string($con, $_POST['school_name']);
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$newpassword = mysqli_real_escape_string($con, $_POST['newpassword']);
		$confirmnewpassword = mysqli_real_escape_string($con, $_POST['confirmnewpassword']);

		if (empty($school_name)) {array_push($errors, "You need to school_name security question");}
		if (empty($username)) {array_push($errors, "Invalid username");}
		if (empty($newpassword)) {array_push($errors, "Enter valid password");}

		if ($newpassword != $confirmnewpassword) {array_push($errors, "passwords do not match");}

		if (count($errors) == 0) {
			$query = "SELECT * FROM crud_table WHERE school_name='$school_name' AND username='$username'";
			$results = mysqli_query($con, $query);

			if (mysqli_num_rows($results) == 1) {

				$newpassword = md5($newpassword);
				$sql = "UPDATE crud_table SET password='$newpassword' where username='$username'";
				mysqli_query($con, $sql);

				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You changed your password";
				header('location: forget.php');
			}else {
				array_push($errors, "Wrong Username or enter a valid school_name");
			}
		}
	}


?>
