<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $project_name = $_POST["project_name"];
    $project_des = $_POST["project_description"];
    $supervisor_email = $_POST["supervisor_email"];

    echo "$supervisor_email";

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

    if($signinemail===$supervisor_email){
        $_SESSION['error']="You are Creating Project as Member. Insert Correct Superviosr Email.";
        header("Location: ProjectCreateFormM.php");
        exit;   
    }
    else{

         $sql2= "SELECT * FROM users WHERE User_Email='$supervisor_email'";
         $result = $conn->query($sql2);

            if ($result->num_rows >0) {
            $row = $result->fetch_assoc();

            $supervisorId = $row["User_Id"];
            $supervisorName = $row["User_Name"];
        

            $sql3 = "INSERT INTO projects (Project_Name, Project_Description,Supervisor_Id,Accept_Status,Creator_Id) 
            VALUES ('$project_name','$project_des','$supervisorId','NO','$Sign_In_Email_Id')";
            if ($conn->query($sql3) === TRUE) {
                // echo "project create successful.";
            } 
            else {
                echo "Error: " . $sql3 . "<br>" . $conn->error;
            }
            $sql4 = "SELECT MAX(Project_Id) AS Max_Project_Id FROM projects";
            $result4 = $conn->query($sql4);

            if ($result4->num_rows > 0) {
                $row = $result4->fetch_assoc();
                $maxProjectId = $row["Max_Project_Id"];

                $_SESSION['projectId'] = $maxProjectId; //projectId

            }

            $sql6 = "INSERT INTO project_members (Project_Id,Member_Id,Join_Status) 
            VALUES ('$maxProjectId','$Sign_In_Email_Id','YES')";
            if ($conn->query($sql6) === TRUE) {
                // echo "supervisors insert successful.";
            } else {
            echo "Error: " . $sql6 . "<br>" . $conn->error;
            }

            


        $subject = "Your are invited as supervisor in project ".$project_name;
        $message = "Use the join ID to Join Your Project:\n";
        $message .= "Join ID: ".$maxProjectId;
        $headers = "From: iit.kanban.board.nstu@gmail.com";

        if(mail($supervisor_email, $subject, $message, $headers)){
                
                $_SESSION['Supervisor_Id']="$supervisorId";
                $_SESSION['Creator_Id']="$Sign_In_Email_Id";

                header("Location: home.php");
                exit;
        }


        
    }else{
        
        $subject = "Invitation for join IIT Kanban Board.";
        $message = "Please Creat Account For Join to IIT Kanban Board for manage your Software Project Lab(SPL).\n";
        $message .=
        $headers = "From: iit.kanban.board.nstu@gmail.com";
    
        if(mail($supervisor_email, $subject, $message, $headers)){
            $_SESSION['error'] = "Given email has no Account. A Invitation Email Sent.";
            header("Location: ProjectCreateFormM.php");
    
        }else{
            $_SESSION['error'] = "No available account & Invitation failed.<a href='InviteMemberToJoin.php'>Please Invite First!</a>";
            header("Location: ProjectCreateFormM.php");
        }
        exit; 
    }


    }
$conn->close();
}



            
        
