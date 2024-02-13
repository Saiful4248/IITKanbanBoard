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
            background: linear-gradient(to right,
                    #ff5733,
                    #ffc300,
                    #4caf50);
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
            transform: scale(1.1); /* Enlarge on hover */
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
            width: 100%; /* Responsive width */
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

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];
}

if (isset($_GET['task_name'])) {
    $task_name = $_GET['task_name'];
}

if (isset($_GET['task_description'])) {
    $task_description = $_GET['task_description'];
}

if (isset($_GET['Creation_Date'])) {
    $creation_date = $_GET['Creation_Date'];
}

if (isset($_GET['Set_Priority'])) {
    $set_priority = $_GET['Set_Priority'];
}

?>


<body>
    <header class="header">
       
        
    </header>
    <div class="container">
        <div class="main-section">
            <h2>Task Name : <?php echo $task_name; ?></h2>
            
            <h3>Task Description : <?php echo $task_description ; ?></h3>
            <h3>Creation Date : <?php echo $creation_date ; ?></h3>
            <h3>Priority : <?php echo $set_priority ; ?></h3>
    
</body>

</html>

<?php

}

else{
    header("Location: signin.php");
}
?>