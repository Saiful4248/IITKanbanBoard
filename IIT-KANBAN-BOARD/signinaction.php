<?php

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ...

    $email = $_POST["email"];
    $password2=$_POST["password"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email format is not correct.";
        header("Location: signin.php"); 
        exit;
    }
    else{

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";    
            $dbname = "iitkanbanboard";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $email_check_query = "SELECT * FROM users WHERE User_Email='$email'";
            $result = $conn->query($email_check_query);


            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $stored_password = $row['Password']; 

    
                    if(password_verify($password2,$stored_password)) {
                        
                        $_SESSION['signinemail'] = $email;

                        $sql5 = "SELECT * FROM users WHERE User_Email='$email'";
                        $result5 = $conn->query($sql5);

                        if ($result5 === false) {
                        echo "Error executing the query: " . $conn->error;
                        } 
                        else {
                        if ($result5->num_rows > 0) {
                        $row = $result5->fetch_assoc();

                        $Sign_In_Email_Id = $row["User_Id"];
                        $_SESSION['Sign_In_Email_Id'] = $Sign_In_Email_Id; // creator id main user

                        $Sign_In_Email_User_Name = $row["User_Name"];
                        $_SESSION['Sign_In_Email_User_Name'] = $Sign_In_Email_User_Name; // supervisorName
                        } 
                        else {
                        echo "No user found with the email: " . $email;
                        }
                        }
                        
                        header("Location: home.php");
                    }else {
                                $_SESSION['error'] = "Password is incorrect.";
                                //header("Location: signin.php");
                                //var_dump($password2);
                                //var_dump($stored_password);
                                header("Location: signin.php"); 
                                exit;
                            }
            }else{
                $_SESSION['error'] = "Email has no account. SignUp please.";
                header("Location: signin.php"); 
                exit;

            }        
    
        }

        $conn->close();

}
?>



