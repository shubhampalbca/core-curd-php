<?php
	$msg="";
	include('config.php');
	include('fun.php');
	if( isset($_GET['id']) ){
		$id=$_GET['id'];
		$sql = "DELETE FROM student WHERE id='$id' ";
	    if(mysqli_query($conn, $sql)){
			//echo "Record  deleted";
			header('Location: view.php?msg=Successfully Deleted');
		}else{
			echo "can not deleted";
		}
	}
?>