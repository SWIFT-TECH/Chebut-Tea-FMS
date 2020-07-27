<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$centre = $_POST['centre'];
		//$time_in = $_POST['time_in'];
		//$time_in = date('H:i:s', strtotime($time_in));
		//$time_out = $_POST['time_out'];
		//$time_out = date('H:i:s', strtotime($time_out));

		$sql = "INSERT INTO collection_centre (centre, time_in, time_out) VALUES ('$centre', '$time_in', '$time_out')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Collection Centre added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: centre.php');

?>