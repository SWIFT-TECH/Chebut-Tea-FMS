<?php
	if(isset($_POST['employee'])){
		$output = array('error'=>false);

		include 'conn.php';
		include 'timezone.php';

		$employee = $_POST['employee'];
		//$status = $_POST['status'];
		$kgs = $_POST['kgs'];

		$sql = "SELECT * FROM farmers WHERE employee_id = '$employee'";
		$query = $conn->query($sql);

		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$id = $row['id'];

			$date_now = date('Y-m-d');

			if($kgs > 1){
				$sql = "SELECT * FROM records WHERE employee_id = '$id' AND date = '$date_now' AND kg IS NOT NULL";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'You have recorded for today';
				}
				else{
					//updates
					//$sched = $row['schedule_id'];
					//$lognow = date('H:i:s');
					//$sql = "SELECT * FROM collection_centre WHERE id = '$sched'";
					//$squery = $conn->query($sql);
					//$srow = $squery->fetch_assoc();
					//$logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
					//
					$sql = "INSERT INTO records (employee_id, date, kg) VALUES ('$id', '$date_now', '$kgs')";
					if($conn->query($sql)){
						//$output['message'] = 'Time in: '.$row['firstname'].' '.$row['lastname'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $conn->error;
					}
				}
			}
			else{
				$sql = "SELECT *, records.id AS uid FROM records LEFT JOIN farmers ON farmers.id=records.employee_id WHERE records.employee_id = '$id' AND date = '$date_now'";
				$query = $conn->query($sql);
				if($query->num_rows < 0){
					$output['error'] = true;
					$output['message'] = 'Cannot Update. No Record.';
				}
				else{
					$row = $query->fetch_assoc();
					if($row['kgs'] != '0'){
						$output['error'] = true;
						$output['message'] = 'Please Check Input';
					}
					else{
						
						$sql = "UPDATE records SET kg = $kgs WHERE id = '".$row['uid']."'";
						if($conn->query($sql)){
							$output['message'] = 'Recording: '.$row['firstname'].' '.$row['lastname'];

							$sql = "SELECT * FROM records WHERE id = '".$row['uid']."'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$kgs = $urow['kg'];
							$kgs = $urow['kg'];

							$sql = "SELECT * FROM farmers LEFT JOIN collection_centre ON collection_centre.id=farmers.schedule_id WHERE farmers.id = '$id'";
							$query = $conn->query($sql);
							$srow = $query->fetch_assoc();

							if($srow['time_in'] > $urow['time_in']){
								$time_in = $srow['time_in'];
							}

							if($srow['time_out'] < $urow['time_in']){
								$time_out = $srow['time_out'];
							}
							$kgs = $row['kgs'];
							$time_in = new DateTime($time_in);
							$time_out = new DateTime($time_out);
							$interval = $time_in->diff($time_out);
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$int = $hrs + $mins;
							if($int > 4){
								$int = $int - 1;
							}

							$sql = "UPDATE records SET kg = '$kgs' WHERE id = '".$row['uid']."'";
							$conn->query($sql);
						}
						else{
							$output['error'] = true;
							$output['message'] = $conn->error;
						}
					}
					
				}
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Farmer ID not found';
		}
		
	}
	
	echo json_encode($output);

?>