<?php

session_start();

if(isset($_SESSION['signinemail'])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, skyblue,green);
            margin: 0;
            padding: 0;

        }

        header {
            text-align: center;
            padding: 20px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }

        header:hover {
            background: linear-gradient(135deg, #ff0080, #ff8a00);
        }

        main {
            max-width: 800px;
            margin: 0 auto;
            padding: 95px;
        }

        form {
            background-color: darkkhaki;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px; /* Increased border radius for a rounded look */
            font-size: 18px; /* Increased font size for better readability */
            background-color: transparent; /* Set input background color to transparent */
            color: #333; /* Dark text color */
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007BFF; /* Change border color on focus */
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add a subtle box shadow on focus */
        }

        button {
            background-color: #006400; /* Dark green button color */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #800000; /* Maroon button color on hover */
        }

        footer {
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }

        footer:hover {
            background: linear-gradient(135deg, #ff0080, #ff8a00);
        }

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
    <header>
        <h1>Create Project</h1>
    </header>
    <main>
        <form id="join-form" action="ProjectCreateFormMaction.php" method="post">
                <?php
                if (isset($_SESSION['error'])) {
                echo '<div class="alert">';
                echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
                echo $_SESSION['error'];
                echo '</div>';
                unset($_SESSION['error']); // Clear the error message
                }
                ?>
            <div class="form-group">
                <label for="project_name">Project Name</label>
                <input type="text" id="p_name" name="project_name" required>
            </div>
            <div class="form-group">
                <label for="project_description">Project Description</label>
                <input type="text" id="p_description" name="project_description" required>
            </div>
            <div class="form-group">
                <label for="supervisor_email">Supervisor Email</label>
                <input type="email" id="invited-email" name="supervisor_email" required>
            </div>
           
            <button type="submit">Create Project</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2023 JoinUs IIT Kanban Board</p>
    </footer>
</body>
        <script>
        function closeAlert() {
            var alert = document.getElementsByClassName("alert")[0];
            alert.style.display = "none";
        }
        </script>
</html>


<?php

}

else{
    header("Location: signin.php");
}
?>
