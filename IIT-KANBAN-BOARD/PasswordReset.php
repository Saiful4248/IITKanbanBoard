
<!DOCTYPE html>
<html>
<head>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
    body {
      background: linear-gradient(to right, green, yellow);
      font-family: 'Roboto', sans-serif;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    h1 {
      text-align: center;
      color: maroon;
      font-size: 36px;
      margin-bottom: 20px;
    }
    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 15px;
    }
    .form-group label {
      color: #0083b0;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .form-group input {
      padding: 10px;
      border: 1px solid #0083b0;
      border-radius: 5px;
      outline: none;
    }
    .button {
      padding: 15px;
      border: none;
      border-radius: 5px;
      color: white;
      background-color: maroon;
      font-size: 18px;
      cursor: pointer;
    }
    .button:hover {
      background-color: darkblue;
    }
    .link-container {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }
    .link {
      color: darkblue;
      text-decoration: none;
      font-size: 14px;
      transition: color 0.3s;
    }
    .link:hover {
      color: maroon;
    }

    /* Add this to your existing CSS */
.alert {
  padding: 20px;
  background-color: GREEN;
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
  </style>
</head>
<body>
  <div class="container">
    <h1>IIT Kanban Board</h1>
    <form action="password_reset.php" method="post">
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
        echo '<div class="alert">';
        echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
        echo $_SESSION['error'];
        echo '</div>';
        unset($_SESSION['error']);
        }
        ?>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <button class="button" id="submit"  type="submit">Reset Password</button>
    </form>


    <div class="link-container">
      <a class="link" href="signin.php" style="margin-left:240px;">Sign In!</a>
    </div>
  </div>
  
  <script>
  // Function to close the alert
  function closeAlert() {
    var alert = document.getElementsByClassName("alert")[0];
    alert.style.display = "none";
  }
</script>

  
</body>
</html>
