<?php

session_start();

if(isset($_SESSION['signinemail'])){

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join In Project</title>

    <!-- icon link delete, add -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>

                /* Add this to your existing CSS */
        .alert {
        padding: 20px;
        background-color: red;
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
        /* Linear Gradient Background */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background: linear-gradient(135deg, green,pink,blue,orange,skyblue);
            /* background: linear-gradient(to right, #FF5733, #FFC300, #4CAF50); */
            color: black;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }


        *{
            box-sizing: border-box;
            font-family: 'Nunito', sans-serif;
        }

    
        input[type="number"]{
            width: 100%;
            font-size: 18px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: maroon;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: green;
        }

        .shadow-box {
            width: 270px;
            padding: 10px;
            margin-left:20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            background-color: #f2f2f2;
            text-align: center;
            border-radius: 10px;
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
            word-wrap: break-word;
            margin-bottom:30px;
        }

        .shadow-box:hover {
            background-color: #b3e0ff;
            transform: scale(1.05);
        }


        .main .project_list .h2 {
            font-size: 15px;
        }

        .main .project_list .p {
            color: #727272;
        }

        @media only screen and (min-width: 768px) {


            section.main .project_list {
                display: flex;
                flex-wrap: wrap;
                /* justify-content: space-between; */
            }
        }

        @media only screen and (min-width: 1024px) {

            section.main {
                width: 100%;
                /* margin-left: 20px;
                margin-right: 20px;  */
            }

        }

        @media only screen and (min-width: 1111px) {

            section.main {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
    <?php
        if (isset($_SESSION['error'])) {
        echo '<div class="alert">';
        echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
        echo $_SESSION['error'];
        echo '</div>';
        unset($_SESSION['error']); 
        }
    ?>
        <h2>Join Project</h2>
        <form action="JoinYourProjectAction.php" method="POST">
            <input type="number" name="join_id" placeholder="Enter Join ID" required>
            <input type="submit" value="Join">
        </form>
    </div>
    <h1 style="color:white; text-align:center; font-size:50px;">YOU ARE IN PROJECT</h1>

    <section class="main" style="margin-left:50px;">
        <div class="project_list"> <!-- main section-->
        <?php
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
            // if (isset($_SESSION['JoinId'])) {
            //     $JoinId = $_SESSION['JoinId'];
            // }


            $infoS=1;
            $sql2 = "SELECT * FROM users u INNER JOIN projects p ON u.User_Id = p.Supervisor_Id WHERE p.Supervisor_Id='$Sign_In_Email_Id' AND p.Supervisor_Id != p.Creator_Id AND p.Accept_Status='YES' ORDER BY p.Project_Id DESC";
            $result2 = $conn->query($sql2);
            
            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {
                   
                    echo '<a style="text-decoration:none; color:black;" href="TaskBoard.php?project_id=' . $row['Project_Id'] . '&user_email=' . $row['User_Email'] . '&project_name=' . urlencode($row['Project_Name']) . '">';

                    echo '<div class="shadow-box">';
                        
                    echo '<h2 style="color:Green">' . $row['Project_Name'] . '</h2>'; 
                    echo '<p><strong>Supervisor:</strong> ' . $row['User_Name'] . '</p>';
                    // echo '<p><strong>Accept Status:</strong> ' . $row['Accept_Status'] . '</p>';

                    echo '<p><strong>Supervisor Email:</strong> ' . $row['User_Email'] . '</p>';
                    echo '<p><strong>Role : Supervisor</strong> '.'</p>';


                    echo '<a href="AddProjectMember.php?project_id=' . $row['Project_Id'] . '&user_email=' . $row['User_Email'] . '&project_name=' . urlencode($row['Project_Name']) . '"><i class="fas fa-user-plus invite-icon" style="color:green; margin-right:30px;"></i></a>';

                    echo '<a href="#" onclick="confirmDelete(' . $row['Project_Id'] . ', ' . $row['Supervisor_Id'] . ', \'' . urlencode($row['Project_Name']) . '\');"><i class="fas fa-trash-alt" style="color: red;"></i></a>';

                    echo '</div>';
                }
            }else{$infoS=0;}

            $infoM=1;

            $sql3 ="SELECT * FROM users u INNER JOIN projects p ON u.User_Id=p.Supervisor_Id INNER JOIN project_members m ON p.Project_Id=m.Project_Id Where m.Member_Id='$Sign_In_Email_Id' AND m.Join_Status = 'YES' ORDER BY p.Project_Id DESC";

            
            $result3 = $conn->query($sql3);              

            if ($result3->num_rows > 0) {
                while ($row = $result3->fetch_assoc()) {
                    echo '<a style="text-decoration:none; color:black;" href="TaskBoard.php?project_id=' . $row['Project_Id'] . '&user_email=' . $row['User_Email'] . '&project_name=' . urlencode($row['Project_Name']) . '">';

                    echo '<div class="shadow-box">';
                        
                    echo '<h2 style="color:Green">' . $row['Project_Name'] . '</h2>'; 
                    echo '<p><strong>Supervisor:</strong> ' . $row['User_Name'] . '</p>';
                    echo '<p><strong>Accept Status:</strong> ' . $row['Accept_Status'] . '</p>';

                    echo '<p><strong>Supervisor Email:</strong> ' . $row['User_Email'] . '</p>';
                    echo '<p><strong>Role : Member</strong> '.'</p>';


                    echo '<a href="AddProjectMember.php?project_id=' . $row['Project_Id'] . '&user_email=' . $row['User_Email'] . '&project_name=' . urlencode($row['Project_Name']) . '"><i class="fas fa-user-plus invite-icon" style="color:green; margin-right:30px;"></i></a>';

                    echo '<a href="#" onclick="confirmDelete(' . $row['Project_Id'] . ', ' . $row['Supervisor_Id'] . ', \'' . urlencode($row['Project_Name']) . '\');"><i class="fas fa-trash-alt" style="color: red;"></i></a>';

                    echo '</div>';

                }

            }else{$infoM=0;}

                
            if($infoS===$infoM){
                    echo '<h1 style="text-align:center; color:green;margin-left:40px">Find Your Project.</h1>';
            }
                

                $conn->close();
        ?>
        

        </div>
    </section>
    


    <div> <!-- footer section-->

    </div>


</body>
        <script>
            function confirmDelete(projectId, supervisorId, projectName) {
            var confirmation = confirm("Are you sure you want to delete the project '" + projectName + "'?");
            if (confirmation) {
                
                window.location.href = "DeleteProjectJoin.php?project_id=" + projectId + "&Supervisor_Id=" + supervisorId;
            }
        }
        </script>

        <script>
            function closeAlert() {
            var alert = document.getElementsByClassName("alert")[0];
            alert.style.display = "none";
            }
        </script>

</html>


<?php

}

else{
    header("Location: signin.php");
}
?>











