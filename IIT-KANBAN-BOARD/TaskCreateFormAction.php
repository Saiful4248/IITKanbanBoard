<?php

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get data from the form
    $task_title = $_POST["task_title"];
    $task_description = $_POST["task_description"];
    $assign_member = $_POST["Assign_Member"];
    $due_date = $_POST["due_date"];
    $priority = $_POST["priority"];



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "iitkanbanboard";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if (isset($_SESSION['project_name'])) {
        $Project_Name = $_SESSION['project_name'];
      }

      
      if (isset($_SESSION['project_Id'])) {
        $Project_Id = $_SESSION['project_Id'];
      }
    // Prepare and execute the SQL insert statement
    $sql = "INSERT INTO tasks (Project_Id,Task_Name,Task_Description,Assign_Member,Due_Date, Set_Priority)
            VALUES ('$Project_Id','$task_title','$task_description','$assign_member', '$due_date','$priority')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['tasksuccess'] = "Task Created successfully.";
        header("Location: TaskCreateForm.php");
    } else {
        $_SESSION['tasksuccess'] = "Task Create Unsuccessful.";
        header("Location: TaskCreateForm.php");
    }
}

$conn->close();
?>