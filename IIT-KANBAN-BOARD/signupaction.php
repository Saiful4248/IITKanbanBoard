<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];
    $name =$_POST["name"];
    $password1 =($_POST["password"]);

    $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email format is not correct.";
        header("Location: signup.php"); 
        exit;
    } 
    else {

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";    
            $dbname = "iitkanbanboard";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Generate a random verification code
            $verificationCode = generateVerificationCode();

            // Insert data into database
            $sql = "INSERT INTO candidate_users (User_Email,User_Name,Password,Status, Verification_Code,Create_time) 
                    VALUES ('$email', '$name', '$hashedPassword', 'Inactive', '$verificationCode', NOW())";

            if ($conn->query($sql) === TRUE) {
                // Send verification email
                sendVerificationEmail($email, $verificationCode);
                exit;
            } 
            else {
                $_SESSION['error']="You already have an account.<a href='signupverify.php'>Please Verify!</a> ";
                $_SESSION['signupemail']=$email;
                header("Location:signup.php");
                exit;
            }

            $conn->close();
        }

}

function generateVerificationCode() {
    // Generate a random 6-character alphanumeric code
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $verificationCode = '';
    for ($i = 0; $i < 6; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $verificationCode .= $characters[$index];
    }
    return $verificationCode;
}

function sendVerificationEmail($to, $verificationCode) {


    $subject = "Email Verification";
    $message = "Enter the Verify_Code for Email Verification: $verificationCode";
    // $message .= "http://localhost/verify.php?email=" . urlencode($to) . "&Verify_Code=" . urlencode($verificationCode);
    $headers = "From: iit.kanban.board.nstu@gmail.com"; 

    if(mail($to, $subject, $message, $headers)){
        $_SESSION['success'] = "Check your mail for verification.";
        $_SESSION['signupemail'] = $to;
        header("Location: signupverify.php");
    }else{
        $_SESSION['success'] = "Verification Email sending failed.";
        header("Location: signupverify.php");
    }

}
?>



