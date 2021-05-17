<?php

include 'connect.php';

$id = $_GET['id'];

 $q = " DELETE FROM crud_table WHERE id = $id ";

mysqli_query($con, $q);

header('location:display.php?message="Sucessfully Deleted"');

?>