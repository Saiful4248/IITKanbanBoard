<?php

session_start();
            
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $email = $_POST["email"];

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

            if (isset($_SESSION['project_Id'])) {
                
                $Project_Id = $_SESSION['project_Id'];
            }

            if (isset($_SESSION['user_email'])) {
                
                $Supervisor_Email = $_SESSION['user_email'];
            }
            if (isset($_SESSION['project_name'])) {
                
                $Project_Name = $_SESSION['project_name'];
            }
        
        if($email===$Supervisor_Email  )
        {
            $_SESSION['success'] ="You can not invite Supervisor as Member.";
            header("Location: AddProjectMember.php");
            exit;
        }
        else{
        
            $sql2= "SELECT * FROM users WHERE User_Email='$email'";
            $result = $conn->query($sql2);

            if ($result->num_rows >0) {
                $row = $result->fetch_assoc();

                $Member_Id = $row["User_Id"];

                $sql7 = "SELECT * FROM project_members WHERE Project_Id = $Project_Id AND Member_Id = $Member_Id";
                $result7 = $conn->query($sql7);

                if ($result7->num_rows >0) {
                    $_SESSION['success'] ="This email already has a membership.";
                    header("Location: AddProjectMember.php");
                    exit;
                }else{
                    $sql6 = "INSERT INTO project_members (Project_Id,Member_Id,Join_Status) 
                    VALUES ('$Project_Id','$Member_Id','NO')";
        
                    if ($conn->query($sql6) === TRUE) {
        
                        $subject = "Member Inviation In Project ";
                        $message = "Your are invited as member in project-\n $Project_Name";
                        $message .= "  Join ID: ".$Project_Id;
                        $headers = "From: iit.kanban.board.nstu@gmail.com";
        
                        if(mail($email, $subject, $message, $headers)){
                            $_SESSION['success'] = "Add Member Successful.";
                            header("Location: AddProjectMember.php");
                            exit;
                        }else{
                            $_SESSION['success'] = "Add Member Failed.";
                            header("Location: AddProjectMember.php");
                            exit;
                        }
                    }else {echo "Error: " . $sql6 . "<br>" . $conn->error;}

                }
            } else{
                $_SESSION['success'] = "Given email has no Account. <a href='InviteMemberToJoin.php'>Please Invite First!</a>";
                header("Location: AddProjectMember.php");
                exit; 
            }

        }
            
    $conn->close();

}



