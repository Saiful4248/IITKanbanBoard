<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "iitkanbanboard";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT * FROM users WHERE User_Email = '$email' ";
        $result = mysqli_query($conn, $query);
    
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $reset_token=bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/Dhaka');
            $date = date('y-m-d');
            $name=$row['User_Name'];
    
            $query = "UPDATE users SET Reset_Token ='$reset_token', Expire ='$date' WHERE User_Email = '$email' ";
            $result = mysqli_query($conn, $query);
    
            if($result){
                $subject = "Reset Password Notification";
                $message = "Hi, $name \n Please click here to reset your password";
                $message.= "<a href='http://localhost/IIT-KANBAN-BOARD/update_password.php?email=$email&reset_token=$reset_token'>Reset Password</a>";
                
                $headers = "From: iit.kanban.board.nstu@gmail.com"; 

                if(mail($email, $subject, $message, $headers)){
                    $_SESSION['error'] = "Check your Email For Password Rest.";
                    header("Location: PasswordReset.php");
            }else{
                $_SESSION['error']="Verification Email Send Failed. Try Again!";
                header("Location: PasswordReset.php");
            }

            }


            else "Server error";
        }
        else{
            echo "invalid email";  
        }

    


    } 
?>