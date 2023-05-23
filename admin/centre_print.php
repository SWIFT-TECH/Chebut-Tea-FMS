<?php
	include 'includes/session.php';

	function generateRow($conn) {
        $contents = '';
        
        $sql = "SELECT farmers.lastname, farmers.firstname, farmers.employee_id, farmers.centre
        FROM farmers" ;

        $query = $conn->query($sql);
        $total = 0;
        while ($row = $query->fetch_assoc()) {
            $contents .= "
            <tr>
                <td>".$row['lastname'].", ".$row['firstname']."</td>
                <td>".$row['employee_id']."</td>
                <td>".$row['centre']."</td>
            </tr>
            ";
        }
    
        return $contents;
    }
    
	// Adjust the path to autoload.php based on the location of payroll_generate.php
    require_once __DIR__ . '/../vendor/autoload.php';

    // Create a new instance of Dompdf
    $dompdf = new \Dompdf\Dompdf();

    // Generate the HTML content
    $html = '
        <h2 align="center">Chebut Tea FMS</h2>
        <h4 align="center">Farmers Tea Collection Centre</h4>
        <table border="1" cellspacing="0" cellpadding="3">
            <tr>
                <th width="40%" align="center"><b>Farmer Name</b></th>
                <th width="30%" align="center"><b>Farmer ID</b></th>
                <th width="30%" align="center"><b>Collection Centre</b></th>
            </tr>
    ';
    $html .= generateRow($conn);
    $html .= '</table>';

    // Load the HTML content into dompdf
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to the browser
    $dompdf->stream('chebut_tea_fms_collection_centres.pdf', array('Attachment' => 0));

?>