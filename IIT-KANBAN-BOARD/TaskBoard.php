<?php

session_start();

if(isset($_SESSION['signinemail'])){

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Task Management</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background: linear-gradient(to right, skyblue, green);
            color: black;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto; /* Center the container horizontally */
            padding: 20px;
        }

        /* Header Styles */
        .header {
            text-align: center;
            padding: 20px;
            background-color: rgba(255,
                    255,
                    255,
                    0.2);
            border-radius: 8px 8px 0 0;
        }

        .header a {
            color: black;
            text-decoration: none;
            margin: 0 20px;
            font-size: 25px;
            transition: transform 0.3s, background-color 0.3s, font-size 0.3s;
        }

        .header a:hover {
            transform: scale(2);
            font-size:30px; /* Enlarge on hover */
        }

        /* Background color and larger size for "List" link */
        .header a.board {
            background-color: skyblue;
            padding: 10px;
            border-radius: 10px;
        }

        /* Button Styles */
        .btn {
            background-color: darkgreen;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: maroon;
            color: yellow;
        }

        /* Task Box Styles */
        .shadow-box {
            width: 70%; /* Responsive width */
            padding: 20px;
            margin: 20px 0; /* Add space between task boxes */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            background-color: #f2f2f2;
            border-radius: 10px;
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
        }

        .shadow-box .icon {
            text-align: center;
        }

        /* Add the hover effect */
        .shadow-box:hover {
            background-color: khaki;
            transform: scale(1.05);
        }


            /* Styles for the "Update Status" button */
            .status-button {
                background-color: darkgreen;
                color:yellow;
                border-radius: 10px;
            }

            .status-button:hover {
                background-color: darkblue; /* Button background color on hover */
            }

            /* Styles for the select input */
            select {
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 14px;
                color: black;
            }

            /* Apply colors to the options within the select */
            select{
                background-color: #ecf0f1; /* Option background color */
                color: #333; /* Option text color */
            }


        
    </style>
</head>




<?php

        $servername = "localhost";
        $username = "root";
        $password = "";    
        $dbname = "iitkanbanboard";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        if (isset($_GET['project_id']) && isset($_GET['user_email']) && isset($_GET['project_name'])) {
            $project_id = $_GET['project_id'];
            $user_email = $_GET['user_email'];
            $project_name = urldecode($_GET['project_name']); 
  
  
            $_SESSION['project_Id']=$project_id;
            $_SESSION['user_email']=$user_email;
            $_SESSION['project_name']=$project_name;
  
        }
  
          if (isset($_SESSION['project_name'])) {
            $Project_Name = $_SESSION['project_name'];
          }
  
          
          if (isset($_SESSION['project_Id'])) {
            $Project_Id = $_SESSION['project_Id'];
          }

          if (isset($_SESSION['Task_Id'])) {
            $Task_Id  =$_SESSION['Task_Id'];
          }

          if (isset($_SESSION['Sign_In_Email_User_Name'])) {
            $User_Name = $_SESSION['Sign_In_Email_User_Name'];
          }

?>


<body>
    <header class="header">
       
        <a href="TaskBoard.php" class="board">Board</a>
        <a href="TaskCreateForm.php" class="list">Create Task</a>
        <a href="Report.php" class="report">Report</a>
        <a href="ProjectDescription.php" class="aboutproject">About Project</a>
        <a href="home.php" class="">Home</a>
    </header>
    <div class="container">
        <div class="main-section">
            <h2>Task Details : <?php echo $Project_Name; ?></h2>

            <?php



            if (isset($_SESSION['signinemail'])) {
                            
                $signinemail = $_SESSION['signinemail'];//signIn or User Email
            }

            

            $sql = "SELECT * FROM users u INNER JOIN tasks t ON u.User_Id=t.Assign_Member WHERE t.Project_Id='$Project_Id' ORDER BY t.Task_Id DESC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<ul style="align:center;">';
                while ($row = $result->fetch_assoc()) {
                    
                    // echo '<a style="text-decoration:none; color:black;" href="TaskInformation.php?project_id=' . $row['Task_Id'] . '&task_description=' . $row['Task_Description'] . '&task_title=' . urlencode($row['Task_Name']) . '">';

                    echo '<div class="shadow-box">';
                    echo '<li>';
                    echo '<strong>Task Title:</strong> ' . $row['Task_Name'] . ' &nbsp;&nbsp;&nbsp;' .
                    '<strong>Assign Member:</strong> ' . $row['User_Email'] . ' &nbsp;&nbsp;&nbsp;' .
                    // '<strong>Due Date:</strong> ' . $row['Creation_Date'] . ' &nbsp;&nbsp;&nbsp;' .
                    '<strong>Due Date:</strong> ' . $row['Due_Date'] . ' &nbsp;&nbsp;&nbsp;' .
                    // '<strong>Set Priority:</strong> ' . $row['Set_Priority'] . ' &nbsp;&nbsp;&nbsp;' .
                    '<strong>Status: </strong> ' . $row['Status'];

                    echo ' <br>
                        <div class="update_status">
                            <form action="Status_Update.php" method="post">
                            <input type="hidden" name="task_id" value="' . $row['Task_Id'] . '">
                                <button class="status-button" type="submit">Update Status</button>
                                <select name="status">
                                    <option value="In Progress">In Progress</option>
                                    <option value="Testing">Testing</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </form>
                        </div>
                        ';
                    
                    
                    echo '<div class="icon">';

                       echo '<a title="Message" href="KanbanBoard_Comments\index.php?project_id=' .$Project_Id. '&user_name=' . $User_Name . '&task_id=' . $row['Task_Id'] .'&task_name=' . $row['Task_Name'] . '"><i class="fas fa-comment invite-icon" style="color: blue; margin-right: 30px;" ></i></a>';

                       echo '<a title="Upload File" href="file_upload_download\index.php?project_id=' .$Project_Id. '&user_name=' . $User_Name . '&task_id=' . $row['Task_Id'] .'&task_name=' . $row['Task_Name'] . '"><i class="fas fa-cloud-upload-alt invite-icon" style="color: green; margin-right: 30px;"></i></a>';

                       echo '<a title="Download File" href="file_upload_download\download.php?project_id=' .$Project_Id. '&task_id=' . $row['Task_Id'] .'&task_name=' . $row['Task_Name'] . '"><i class="fas fa-download invite-icon" style="color: blue; margin-right: 30px;"></i></a>';
                       

                       echo '<a title="Show Description" href="TaskInformation.php?project_id=' .$Project_Name. '&task_name=' . $row['Task_Name'] .'&task_description=' . $row['Task_Description'] .'&Creation_Date=' . $row['Creation_Date'] .'&Set_Priority=' . $row['Set_Priority'] . '"><i class="fas fa-info-circle" style="color: darkblue; margin-right: 30px;"></i></a>';
                       

                    //    echo '<i class="fas fa-trash-alt" style="color: red;"></i>'; 
                    
                    echo '</div>';
                    
                echo '</div>';
                }
                echo '</ul>';
            } else {
                echo '<h2 style="color:white;font-size:50px;text-align:center;">No tasks found for this project.</h2>';
            }

            $conn->close();
            ?>

            <button type="submit" class="btn" onclick="window.location.href='TaskCreateForm.php'">Create Task</button>
        </div>
    </div>



    <script>
        // Function to close the alert
        function closeAlert() {
            var alert = document.getElementsByClassName("alert")[0];
            alert.style.display = "none";
        }
    </script>
</body>

</html>

<?php

}

else{
    header("Location: signin.php");
}
?>