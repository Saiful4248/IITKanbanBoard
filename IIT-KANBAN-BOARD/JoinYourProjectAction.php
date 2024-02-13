<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $joinID = $_POST["join_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "iitkanbanboard";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_SESSION['signinemail'])) {
                                
        $signinemail = $_SESSION['signinemail'];
    } 

    if (isset($_SESSION['Sign_In_Email_Id'])) {
                
        $Sign_In_Email_Id = $_SESSION['Sign_In_Email_Id'];
    }

    


    $sql = "SELECT Project_Id, Supervisor_Id FROM projects WHERE Project_Id = '$joinID' AND Supervisor_Id='$Sign_In_Email_Id' AND Accept_Status='NO'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $updateSql = "UPDATE projects SET Accept_Status = 'YES' WHERE Project_Id = '$joinID' AND Supervisor_Id = '$Sign_In_Email_Id' AND Accept_Status = 'NO'";

        if ($conn->query($updateSql) === TRUE) {
            header("Location: JoinYourProject.php");
            exit;
        }
        else{
            $_SESSION['update_error']="Update Unsuccessful OR already Updated";
            header("Location: JoinYourProject.php");
            exit;

        } 
    }else{
        $sql1 = "SELECT * FROM project_members WHERE Project_Id = '$joinID' AND Member_Id='$Sign_In_Email_Id' AND Join_Status='NO'";
        $result = $conn->query($sql1);

        if ($result->num_rows > 0) {
            $updateSql = "UPDATE project_members SET Join_Status = 'YES' WHERE Project_Id = '$joinID' AND Member_Id = '$Sign_In_Email_Id' AND Join_Status = 'NO'";
    
            if ($conn->query($updateSql) === TRUE) {
                $_SESSION['JoinId']=$joinID;
                header("Location: JoinYourProject.php");
                exit;
            }
            else{
                $_SESSION['JoinId']=$joinID;
                header("Location: JoinYourProject.php");
                exit;
            }

        }else{
            header("Location: JoinYourProject.php");
            exit;
        }

    }

    $conn->close();
}
?>