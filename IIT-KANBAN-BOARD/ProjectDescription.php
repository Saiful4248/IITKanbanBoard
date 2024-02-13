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
    <style>
        /* Linear Gradient Background */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background: linear-gradient(to right,  skyblue, green);
            /* Customize gradient colors */
            color: black;
            text-align: center;
        }

        /* Container */
        .container {
            max-width: 600px;
            margin: 0 auto;
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
            /* Semi-transparent header background */
            border-radius: 8px 8px 0 0;
            /* Rounded top corners */
        }

        .header a {
            color: black;
            text-decoration: none;
            margin: 0 20px;
            font-size: 25px;
            transition: transform 0.3s, background-color 0.3s, font-size 0.3s;
            /* Smooth hover effect for transform, background, and font-size */
        }

        .header a:hover {
            transform: scale(2);
            /* Enlarge on hover */
            font-size: 30px;
            /* Larger font size on hover */
        }

        /* Background color and larger size for "List" link */
        .header a.aboutproject {
            background-color: skyblue;
            padding: 10px;
            border-radius: 10px;
        }

        /* Main Section Styles */
        .main-section {
            background-color: rgba(255,
                    255,
                    255,
                    0.2);
            /* Semi-transparent card background */
            padding: 5px;
            padding-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 8px 8px;
            /* Rounded bottom corners */
        }

        #Assign_Member {
            width: 88.5%;
        }

        #priority {
            width: 88.5%;
        }

        /* Input Fields */
        .input-field {
            width: 85%;
            font-size: 18px;
            padding: 10px;
            border: none;
            border-color: darkgreen;
            border-radius: 4px;
            margin-bottom: 10px;
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
            /* Smooth hover effect */
        }

        .btn:hover {
            background-color: maroon;
            color: yellow;
        }



        /* Add this to your existing CSS */
        .alert {
            padding: 20px;
            background-color: green;
            color: white;
            margin-bottom: 15px;
            position: relative;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
</head>


<?php

if (isset($_SESSION['project_name'])) {
    $Project_Name = $_SESSION['project_name'];
}

  
if (isset($_SESSION['project_Id'])) {
    $Project_Id = $_SESSION['project_Id'];
}

if (isset($_SESSION['project_Id'])) {
    $Project_Id = $_SESSION['project_Id'];
  }

  if (isset($_SESSION['Task_Id'])) {
    $Task_Id  =$_SESSION['Task_Id'];
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
          <h1>About : <?php echo $Project_Name; ?></h1>
        <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "iitkanbanboard";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }


                $sql1 = "SELECT Project_Description FROM  projects WHERE Project_Id='$Project_Id'";
                $result = $conn->query($sql1);                

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<p ><strong>Description:</strong> ' . $row['Project_Description'] . '</p>';
                    }
                }
                $conn->close();
        ?>
        </div>
    </div>
</body>

</html>

<?php

}

else{
    header("Location: signin.php");
}
?>