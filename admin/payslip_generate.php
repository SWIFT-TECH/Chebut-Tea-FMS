<?php
    include 'includes/session.php';

    $range = $_POST['date_range'];
    $ex = explode(' - ', $range);
    $from = date('Y-m-d', strtotime($ex[0]));
    $to = date('Y-m-d', strtotime($ex[1]));

    $sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
    $query = $conn->query($sql);
    $drow = $query->fetch_assoc();
    $deduction = $drow['total_amount'];

    $from_title = date('M d, Y', strtotime($ex[0]));
    $to_title = date('M d, Y', strtotime($ex[1]));

    //require_once('../vendor/autoload.php');
	// Adjust the path to autoload.php based on the location of payroll_generate.php
	require_once __DIR__ . '/../vendor/autoload.php';

	use Dompdf\Dompdf;
	use Dompdf\Options;

	$options = new Options();
	$options->set('isRemoteEnabled', true);
	$options->set('defaultFont', 'Helvetica');
	$pdf = new Dompdf($options);
	$pdf->setPaper('A4', 'portrait');

	$contents = '';


    $sql = "SELECT *, SUM(kg) AS total_kg, records.employee_id AS empid, farmers.employee_id AS employee FROM records LEFT JOIN farmers ON farmers.id=records.employee_id LEFT JOIN rates ON rates.id=farmers.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY records.employee_id ORDER BY farmers.lastname ASC, farmers.firstname ASC";

    $query = $conn->query($sql);
    while($row = $query->fetch_assoc()){
        $empid = $row['empid'];
                      
        $casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
      
        $caquery = $conn->query($casql);
        $carow = $caquery->fetch_assoc();
        $cashadvance = $carow['cashamount'];

        $gross = $row['rate'] * $row['total_kg'];
        $total_deduction = $deduction + $cashadvance;
        $net = $gross - $total_deduction;

        $contents .= '
            <h2 align="center">Chebut Tea FMS</h2>
            <h4 align="center">'.$from_title." - ".$to_title.'</h4>
            <table cellspacing="0" cellpadding="3">  
                <tr>  
                    <td width="25%" align="right">Farmer Name: </td>
                    <td width="25%"><b>'.$row['firstname']." ".$row['lastname'].'</b></td>
                    <td width="25%" align="right">Rate per KG: </td>
                    <td width="25%" align="right">'.number_format($row['rate'], 2).'</td>
                </tr>
                <tr>
                    <td width="25%" align="right">Farmer ID: </td>
                    <td width="25%">'.$row['employee'].'</td>   
                    <td width="25%" align="right">Total KGS: </td>
                    <td width="25%" align="right">'.number_format($row['total_kg'], 2).'</td> 
                </tr>
                <tr> 
                    <td></td> 
                    <td></td>
					<td width="25%" align="right"><b>Gross Pay: </b></td>
                    <td width="25%" align="right"><b>'.number_format(($row['rate']*$row['total_kg']), 2).'</b></td> 
                </tr>
                <tr> 
                    <td></td> 
                    <td></td>
                    <td width="25%" align="right">Deduction: </td>
                    <td width="25%" align="right">'.number_format($deduction, 2).'</td> 
                </tr>
                <tr> 
                    <td></td> 
                    <td></td>
                    <td width="25%" align="right">Cash Advance: </td>
                    <td width="25%" align="right">'.number_format($cashadvance, 2).'</td> 
                </tr>
                <tr> 
                    <td></td> 
                    <td></td>
                    <td width="25%" align="right"><b>Total Deduction:</b></td>
                    <td width="25%" align="right"><b>'.number_format($total_deduction, 2).'</b></td> 
                </tr>
                <tr> 
                    <td></td> 
                    <td></td>
                    <td width="25%" align="right"><b>Net Pay:</b></td>
                    <td width="25%" align="right"><b>'.number_format($net, 2).'</b></td> 
                </tr>
            </table>
            <br><hr>
        ';
    }

    $pdf->loadHtml($contents);
    $pdf->render();
    $pdf->stream('payslip.pdf', ['Attachment' => false]);
?>

