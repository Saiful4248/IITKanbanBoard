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


    if($supervisor_id !=$Sign_In_Email_Id)
    {
        $_SESSION['error'] ="Member has no permission to delete project.";
        header("Location: JoinYourProject.php"); 
        exit();

    }else{
        $sql2 = "DELETE FROM projects WHERE Project_Id = '$project_id' AND Supervisor_Id = '$Sign_In_Email_Id'";
        if ($conn->query($sql2) === TRUE) {
            header("Location: JoinYourProject.php"); 
            exit();
        }
        else{
            header("Location: JoinYourProject.php"); 
            exit();
        }

    }

    $conn->close();
}
?>
