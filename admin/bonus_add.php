<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$date = $_POST['date'];
		$kgs = $_POST['kgs'] + ($_POST['mins']/1000);
		$rate = $_POST['rate'];
		$sql = "SELECT * FROM farmers WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Farmer not found';
		}
		else{
			$row = $query->fetch_assoc();
			$employee_id = $row['id'];
			$sql = "INSERT INTO bonus (employee_id, date_bonus, kgs, rate) VALUES ('$employee_id', '$date', '$kgs', '$rate')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Bonus added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: bonus.php');

?>