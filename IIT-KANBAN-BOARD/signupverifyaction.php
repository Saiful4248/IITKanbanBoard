<?php

session_start();

if (isset($_GET['code'])) {

    $code = $_GET['code'];


    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "iitkanbanboard";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_SESSION['signupemail'])) {

        $signupemail = $_SESSION['signupemail'];
    }


    $sql4 = "DELETE FROM candidate_users WHERE Status = 'Inactive' AND Create_time < DATE_SUB(NOW(), INTERVAL 1 HOUR)";



    // Check if email and code match
    $verification_query = "SELECT * FROM candidate_users WHERE User_Email='$signupemail' AND Verification_Code='$code'";
    $result = $conn->query($verification_query);

    if ($result->num_rows >0) {
        $row = $result->fetch_assoc();
        
        $sql1 = "INSERT INTO users (User_Email,User_Name,Password)
                VALUES ('$row[User_Email]', '$row[User_Name]', '$row[Password]')";

        if ($conn->query($sql1) === TRUE) {
            $_SESSION['success'] = "Account created successfully! You can now Sign In.";
            // Delete from dummy table
            
            $dummyUserEmail = $row['User_Email'];
           
                $sql2 = "DELETE FROM candidate_users WHERE User_Email = '$dummyUserEmail'";
              
                if ($conn->query($sql2) === TRUE) {
                    echo "User verified and moved to the verified user table.";
                 } else {
                    echo "Error: " . $sql2 . "<br>" . $conn->error;
                        }

                header("Location: signin.php");
            

              
            } else{
                $_SESSION['success'] = "This Email Already Have An Account. Try to Sign In." ;
                $sql2 = "DELETE FROM candidate_users WHERE User_Email = '$signupemail'";
                header("Location: signin.php");

            }

        } else {
            $_SESSION['error'] = "Invalid Email Or Verification Code? Recheck please.";
            header("Location: signupverify.php");
            exit;
        }
   
    
    $conn->close();
} else {
    $_SESSION['error'] = "  Get Email Get code not work!";
    header("Location: signupverify.php");
    exit;
}
?>


