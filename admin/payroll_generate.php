<?php
// Adjust the path to autoload.php based on the location of payroll_generate.php
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;

include 'includes/session.php';

function generateRow($from, $to, $conn, $deduction){
    $contents = '';

    $sql = "SELECT *, sum(kg) AS total_kg, records.employee_id AS empid FROM records LEFT JOIN farmers ON farmers.id=records.employee_id LEFT JOIN rates ON rates.id=farmers.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY records.employee_id ORDER BY farmers.lastname ASC, farmers.firstname ASC";

    $query = $conn->query($sql);
    $total = 0;
    while($row = $query->fetch_assoc()){
        $empid = $row['empid'];

        $casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";

        $caquery = $conn->query($casql);
        $carow = $caquery->fetch_assoc();
        $cashadvance = $carow['cashamount'];

        $gross = $row['rate'] * $row['total_kg'];
        $total_deduction = $deduction + $cashadvance;
        $net = $gross - $total_deduction;

        $total += $net;
        $contents .= '
        <tr>
            <td>'.$row['firstname'].' '.$row['lastname'].'</td>
            <td>'.$row['employee_id'].'</td>
            <td align="right">'.number_format($net, 2).'</td>
        </tr>
        ';
    }

    $contents .= '
        <tr>
            <td colspan="2" align="right"><b>Total</b></td>
            <td align="right"><b>'.number_format($total, 2).'</b></td>
        </tr>
    ';
    return $contents;
}

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

// Create a new Dompdf instance
$pdf = new Dompdf();

// Load HTML content
$html = '
<!DOCTYPE html>
<html>
<head>
  <title>Payroll: '.$from_title.' - '.$to_title.'</title>
</head>
<body>
    <h2 align="center">Chebut Tea FMS</h2>
    <h4 align="center">'.$from_title." - ".$to_title.'</h4>
    <table border="1" cellspacing="0" cellpadding="3">  
        <tr>  
            <th width="40%" align="center"><b>Farmer Name</b></th>
            <th width="30%" align="center"><b>Farmer ID</b></th>
            <th width="30%" align="center"><b>Net Pay</b></th> 
        </tr>  
        '.generateRow($from, $to, $conn, $deduction).'
    </table>
</body>
</html>
';

// Load HTML content into Dompdf
$pdf->loadHtml($html);

//
// Set paper size and orientation
$pdf->setPaper('A4', 'portrait');

// Render the PDF
$pdf->render();

// Output the generated PDF
$pdf->stream('payroll.pdf', array('Attachment' => false));