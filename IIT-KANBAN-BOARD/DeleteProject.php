<?php
  session_start();
if (isset($_GET['project_id']) && isset($_GET['Supervisor_Id'])) {
    $project_id = $_GET['project_id'];
    $supervisor_id = $_GET['Supervisor_Id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "iitkanbanboard";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_SESSION['Sign_In_Email_Id'])) {
        $Sign_In_Email_Id = $_SESSION['Sign_In_Email_Id'];
    }


    $sql = "DELETE FROM projects WHERE Project_Id = '$project_id' AND ((Supervisor_Id = '$Sign_In_Email_Id') OR( Creator_Id='$Sign_In_Email_Id' AND Accept_Status = 'NO')) ";

    if ($conn->query($sql) === TRUE) {
        header("Location: home.php"); 
        exit();
    } else {
        // Display an alert with the database error message
        echo '<script>alert("Member has no permission to delete project. Error: ' . $conn->error . '");</script>';
        header("Location: JoinYourProject.php"); 
        exit();
    }

    $conn->close();
}
?>
