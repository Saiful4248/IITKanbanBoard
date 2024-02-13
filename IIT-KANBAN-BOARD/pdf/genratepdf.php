<?php
session_start();
require('fpdf/fpdf.php'); // Include FPDF library

class PDF extends FPDF {
    // Page header
    function Header() {
        // Title
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Task Details', 0, 1, 'C');
    }

    // Page content
    function Content($data) {
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(200, 200, 200);

        // Table header
        $this->Cell(40, 10, 'Task Name', 1, 0, 'C', 1);
        $this->Cell(60, 10, 'Task Description', 1, 0, 'C', 1);
        $this->Cell(40, 10, 'Assigned Member', 1, 0, 'C', 1);
        $this->Cell(40, 10, 'Due Date', 1, 1, 'C', 1);

        // Table data
        foreach ($data as $row) {
            $this->Cell(40, 10, $row->Task_Name, 1);
            $this->Cell(60, 10, $row->Task_Description, 1);
            $this->Cell(40, 10, $row->Assign_Member, 1);
            $this->Cell(40, 10, date("d-m-Y", strtotime($row->Due_Date)), 1);
            $this->Ln(); // Move to the next row
        }
    }
}

if (isset($_SESSION['project_name'])) {
    $Project_Name = $_SESSION['project_name'];
}

if (isset($_SESSION['project_Id'])) {
    $Project_Id = $_SESSION['project_Id'];
}

try {
    // Establish a database connection (update with your database credentials)
    $dbh = new PDO('mysql:host=localhost;dbname=iitkanbanboard', 'root', '');

    // Execute the SQL query to retrieve task details
    $sql = "SELECT Task_Name, Task_Description, Assign_Member, Due_Date FROM tasks WHERE Project_Id = :project_id";
   

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':project_id', $Project_Id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Fetch the data
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    
    // Create a PDF object
    $pdf = new PDF();
    $pdf->AddPage();
    
    if (!empty($data)) {
        // Pass the fetched data to the Content method
        $pdf->Content($data);
    } else {
        // Handle the case where no data is available
        $pdf->Cell(0, 10, 'No data available.', 0, 1, 'C');
    }
    
    // Output the PDF to the browser
    $pdf->Output();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
