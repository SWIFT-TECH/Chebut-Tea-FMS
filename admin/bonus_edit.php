<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$date = $_POST['date'];
		$kgs = $_POST['kgs'] + ($_POST['mins']/60);
		$rate = $_POST['rate'];

		$sql = "UPDATE bonus SET kgs = '$kgs', rate = '$rate', date_bonus = '$date' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Bonus updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:bonus.php');

?>