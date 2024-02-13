<?php

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $selectedStatus = $_POST["status"];
    $task_id = $_POST["task_id"];


            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";    
            $dbname = "iitkanbanboard";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_SESSION['project_Id'])) {
                $Project_Id = $_SESSION['project_Id'];
              }

            if (isset($_SESSION['Sign_In_Email_Id'])) {
                $Assign_Member_Id = $_SESSION['Sign_In_Email_Id'];
              }

              $sql = "UPDATE tasks SET Status = '$selectedStatus' WHERE Task_Id = $task_id AND Project_Id = $Project_Id AND Assign_Member = $Assign_Member_Id";

              if ($conn->query($sql) === TRUE) {
                  header("Location: TaskBoard.php");
                  exit();
              } else {
                  header("Location: TaskBoard.php");
                  exit();
              }
          
    
              $conn->close();

}
?>



