<?php

session_start();

if(isset($_SESSION['signinemail'])){

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IIT KANBAN BOARD</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- icon link delete, add -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="assets\css\icons.css">
    <link rel="stylesheet" href="assets\css\style.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>

    <style>

                .dropdown {
                    position: relative;
                    display: inline-block;
                }

                .dropbtn {
                    background-color: maroon;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    cursor: pointer;
                    border-radius: 10px;
                    margin-top:10px;
                }
                .dropbtn:hover{
                    background-color: darkgreen;
                }

                .dropdown-content {
                    display: none;
                    position: absolute;
                    min-width: 160px;
                    z-index: 1;
                    margin-left:10px;
                }

                .dropdown-content a {
                    margin-top: 1px;
                    padding: 5px;
                    text-decoration: none;
                    display: block;
                    color: black;
                    border-radius: 5px;
                    box-shadow: 0px 8px 16px 0px rgba(87, 82, 82, 0.2);
                    border-color: gray;
                }

            
                .dropdown-content a:hover {
                    color:darkblue;
                    background-color:aquamarine;
                }

                .dropdown:hover .dropdown-content {
                    display: block;
                }


                .shadow-box {
                    width: 270px;
                    padding: 15px;
                    margin-top:65px;
                    margin-bottom:5px;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                    background-color: #f2f2f2;
                    text-align: center;
                    border-radius: 10px;
                    transition: background-color 0.3s, transform 0.3s;
                    cursor: pointer;
                    word-wrap: break-word;
                    margin-left:25px;
                
                   
                    }

                .shadow-box:hover {
                    background-color: #b3e0ff;
                    transform: scale(1.05);
                }


                .invite-icon {
                    color: green;
                    margin-right: 10px;
                }

                .delete-icon {
                    color: red;
                }

                .invite-icon,
                .delete-icon {
                    cursor: pointer;
                }

    </style>



</head>

<body>
    <div class="dashboard">
        <section class="navigation">
            <img src="assets\img\iit.jpg" alt="IIT Kanban_Board" class="logo">
            <div>
                <span style="text-decoration:none; color:darkblue;margin-top:20px;" href="home.php" class="material-icons-outlined"  title="HOME"> dashboard </span>
                
                <a href="InviteMemberToJoin.php" style="text-decoration:none; color:darkblue;margin-top:20px;" href="#" class="material-icons-outlined"  title="INVITE MEMBER"> people_alt </a>
                

                <span style="text-decoration:none; color:orange;margin-top:20px;" href="#" class="material-icons-outlined"  title="NOTE"> insert_invitation </span>

                <a style="text-decoration: none; color: green; margin-top: 20px;" href="JoinYourProject.php" class="material-icons-outlined" title="Join Your Project">group_add</a>

                <a style="text-decoration: none; color: red; margin-top: 20px; margin-left:5px;" href="logout.php" class="material-icons" title="Logout">exit_to_app</a>


            </div>

        </section>


        <section class="main">
            <div class="search">
                <form action="">
                </form>

                <div class="notification">
                    <span class="material-icons-outlined"> notifications </span>
                </div>
                
            </div>

            <div class="title">
            <h1 id="typewriter"></h1>
                <h1 style="font-size:30px">My Project</h1>

            </div>

        <div style="margin-top:1px; margin-left:3px;" class="dropdown">
            <button class="dropbtn">Create Project</button>
                <div class="dropdown-content">
                    <a href="ProjectCreateFormS.php">As Supervisor</a>
                    <a href="ProjectCreateFormM.php">As Member</a>
                </div>
        </div>
            <br>

            <div class="project_list">

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

                    $Sign_In_Email_Id= $_SESSION['Sign_In_Email_Id'];
                }
                if (isset($_SESSION['Supervisor_Id'])) {

                    $Supervisor_Id= $_SESSION['Supervisor_Id'];
                }

                

                $sql1 = "SELECT * FROM users u INNER JOIN projects p ON u.User_Id = p.Supervisor_Id WHERE p.Creator_Id='$Sign_In_Email_Id' AND (p.Supervisor_Id =$Sign_In_Email_Id OR p.Accept_Status='NO') ORDER BY p.Project_Id DESC";
                $result = $conn->query($sql1);                

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {


                        echo '<a style="text-decoration:none; color:black;" href="TaskBoard.php?project_id=' . $row['Project_Id'] . '&user_email=' . $row['User_Email'] . '&project_name=' . urlencode($row['Project_Name']) . '">';

                        echo '<div class="shadow-box">';

                        echo '<h2 style="color:Green">' . $row['Project_Name'] . '</h2>'; 
                        echo '<p><strong>Supervisor:</strong> ' . $row['User_Name'] . '</p>';

                        echo '<p><strong>Supervisor Email: <br> </strong> ' . $row['User_Email'] . '</p>';
                        echo '<p><strong>Role : Owner</strong> '.'</p>';


                        echo '<a href="AddProjectMember.php?project_id=' . $row['Project_Id'] . '&user_email=' . $row['User_Email'] . '&project_name=' . urlencode($row['Project_Name']) . '"><i class="fas fa-user-plus invite-icon" style="color:green; margin-right:30px;"></i></a>';


                        echo '<a href="#" onclick="confirmDelete(' . $row['Project_Id'] . ', ' . $row['Supervisor_Id'] . ', \'' . urlencode($row['Project_Name']) . '\');"><i class="fas fa-trash-alt" style="color: red;"></i></a>';

                        echo '</div>';

                    }
                } else {
                    echo '<h3 style="text-align:center; color:green;margin-left:180px">Create your first Project</h3>';
                }

                $conn->close();
                ?>
            </div>
        </section>



        <section class="secondary">
            <div class="chart">
                <h2>Total Project</h2>
                <canvas id="myChart" width="100" height="100"></canvas>
            </div>
        </section>

    </div>

    <script>
        const text = "Welcome To IIT Kanban Board";
        const speed = 100;

        let index = 0;
        const typewriter = document.getElementById("typewriter");

        function type() {
        if (index < text.length) {
            typewriter.innerHTML += text.charAt(index);
            index++;
            setTimeout(type, speed);
        } else {
            setTimeout(function () {
                typewriter.innerHTML = "";
                index = 0;
                type();
            }, 2000); 
        }
        }

         window.onload = type();
    </script>
    
    <script>
        window.addEventListener("click", function(event) {
        var dropdowns = document.querySelectorAll(".dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var dropdown = dropdowns[i];
            if (dropdown.classList.contains('show') && !event.target.closest('.dropdown')) {
                    dropdown.classList.remove('show');
                }
            }
        });

    </script>

        <script>
        function confirmDelete(projectId, supervisorId, projectName) {
            var confirmation = confirm("Are you sure you want to delete the project '" + projectName + "'?");
            if (confirmation) {
                
                window.location.href = "DeleteProject.php?project_id=" + projectId + "&Supervisor_Id=" + supervisorId;
            }
        }
        </script>



    <script src="assets/js/script.js"> </script>

</body>

</html>

<?php

}

else{
    header("Location: signin.php");
}
?>
