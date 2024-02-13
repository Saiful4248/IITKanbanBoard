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

        
            $subject = "Invitation for join IIT Kanban Board.";
            $message = "Please Creat Account For Join to IIT Kanban Board for manage your Software Project Lab(SPL).\n";
            $headers = "From: iit.kanban.board.nstu@gmail.com";
        
            if(mail($email, $subject, $message, $headers)){
                $_SESSION['success'] = "Invitation Successful.";
        
                header("Location: InviteMemberToJoin.php");
        
            }else{
                $_SESSION['success'] = "Invitation failed.";
                header("Location: InviteMemberToJoin.php");
            }
        
           

            
            $conn->close();

}


function sendInvitationEmail($to, $rfemail,$conn) {


    

}
?>

