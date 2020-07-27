<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, farmers.id AS empid FROM farmers LEFT JOIN collection_centre ON collection_centre.id=farmers.schedule_id WHERE farmers.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>