<?php
	$conn = new mysqli('localhost', 'root', '', 'chebut');
	//$conn = new mysqli('localhost', 'root', '', 'attendance');
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>