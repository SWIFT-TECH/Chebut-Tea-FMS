<?php
	//$conn = new mysqli('localhost', 'root', '', 'attendance');
	$conn = new mysqli('localhost', 'root', '', 'chebut');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>