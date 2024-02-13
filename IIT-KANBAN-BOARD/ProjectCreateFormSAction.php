<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $project_name = $_POST["project_name"];
    $project_des = $_POST["project_description"];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";    
    $dbname = "iitkanbanboard";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_SESSION['signinemail'])) {
                
        $signinemail = $_SESSION['signinemail'];//signIn or User Email
    }

    if (isset($_SESSION['Sign_In_Email_Id'])) {
                
        $Sign_In_Email_Id = $_SESSION['Sign_In_Email_Id'];//signIn Email Id
    }


    
        

            $sql3 = "INSERT INTO projects (Project_Name, Project_Description,Supervisor_Id,Accept_Status,Creator_Id) 
            VALUES ('$project_name','$project_des','$Sign_In_Email_Id','YES','$Sign_In_Email_Id')";
            if ($conn->query($sql3) === TRUE) {
                header("Location: home.php");
            } else {
                echo "Error: " . $sql3 . "<br>" . $conn->error;
            }


$conn->close();
}



            
        
