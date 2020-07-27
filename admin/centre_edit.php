<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$centre = $_POST['centre'];
		//$time_in = $_POST['time_in'];
		//$time_in = date('H:i:s', strtotime($time_in));
		//$time_out = $_POST['time_out'];
		//$time_out = date('H:i:s', strtotime($time_out));

		$sql = "UPDATE collection_centre SET centre = '$centre', time_in = '$time_in', time_out = '$time_out' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Collection Centre updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:centre.php');

?>