<?php

session_start();

if(isset($_SESSION['signinemail'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(to right, #3498db, #1abc9c);
        color: white; /* Text color */
        font-family: Arial, sans-serif;
        }

        .login-text {
        text-align: center;
        }

        .login-box {
        background: rgba(0, 0, 255, 0.1); /* Semi-transparent white background */
        padding: 20px;
        margin-left:30px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #txt {
        margin-bottom: 20px;
        }

        .user-box {
        position: relative;
        margin-bottom: 30px;
        }

        .user-box input {
        width: 100%;
        padding: 10px 0;
        margin-bottom: 30px;
        border: none;
        outline: none;
        background: transparent;
        border-bottom: 1px solid white;
        color: white;
        }

        .user-box label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        pointer-events: none;
        transition: 0.5s;
        }

        .user-box input:focus ~ label,
        .user-box input:valid ~ label {
        top: -20px;
        font-size: 14px;
        }

        .submit {
        width: 100%;
        background: transparent;
        border: 1px solid white;
        padding: 10px;
        color: white;
        cursor: pointer;
        transition: background 0.3s ease-in-out;
        }

        .submit:hover {
        background: white; /* Background color on hover */
        color: #3498db; /* Text color on hover */
        }

    </style>
</head>
<body>
    <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "iitkanbanboard";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
  
    if(isset($_GET['email']) && isset($_GET['reset_token'])){
       
        $email=$_GET['email'];
        $reset_token=$_GET['reset_token'];
        date_default_timezone_set('Asia/Dhaka');

        $date = date('y-m-d');

        $query = "SELECT * FROM users WHERE User_Email = '$email' AND Reset_Token = '$reset_token' AND Expire = '$date'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            echo "
            <div class='login-text'>
            <h2>Welcome IIT KanBan Board</h2>
          </div>
          <div class='login-box'>
            <h2 id='txt'>Password Reset</h2>
        
            <form id='password-reset-form' method='POST'>
            <div class='user-box'>
            <input type='password' name='new_password' required=''>
            <label>New password</label>
            </div>
            <input class='submit' type='submit' name='reset_pass' value='Reset'>
            <input  type='hidden' name='email' value='$email'>

            </form>
            </div>

            ";
        }
        else{
            echo "<p class='invalid'>Invalid or expire link</p>
                  <a class='invalid'  href='signin.php'>Try again? Login</a>";
        }

    }
    ?>

    <?php
    if(isset($_POST['reset_pass'])){
    
        $email = $_POST['email'];
        $password = $_POST['new_password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
       $sql = "UPDATE users SET Password='$hashedPassword' WHERE User_Email='$email'";
        
       if ($conn->query($sql)=== true) {
        ob_clean();

        echo "<p class='invalid'>congratulations! Your password successfully reset</p>
              <a class='invalid'  href='signin.php'>Login in now</a>";
        
    }
    else{
        echo "<p class='invalid'>Password can't be reset</p>
        <a class='invalid'  href='signin.php'>Try again? Login</a>";
    }

    }
    ?>

</body>
</html>


<?php

}

else{
    header("Location: signin.php");
}
?>