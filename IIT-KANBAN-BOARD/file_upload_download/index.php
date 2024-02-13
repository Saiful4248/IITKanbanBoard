<?php
	session_start();

	if (isset($_GET['project_id']) && isset($_GET['user_name']) && isset($_GET['task_id'])) {
		$project_Id = $_GET['project_id'];
		$User_Name = $_GET['user_name'];
		$task_id = $_GET['task_id'];
	
		$_SESSION['project_Id']=$project_Id;
		$_SESSION['user_name']=$User_Name;
		$_SESSION['task_Id']=$task_id;

	}

	  if (isset($_SESSION['task_Id'])) {
		$Task_Id = $_SESSION['task_Id'];
	  }

	  if (isset($_SESSION['project_Id'])) {
		$Project_Id = $_SESSION['project_Id'];
	  }

	  if (isset($_SESSION['user_name'])) {
		$User_Name = $_SESSION['user_name'];
	  }

    //   if (isset($_GET['task_name'])) {
    //     $task_name = $_GET['task_name'];

    // 

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<title>File upload and download</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, orange, #0056b3); /* Customize gradient colors */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .box {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            transition: transform 0.3s;
        }

        .box:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: maroon;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
    <!-- <h1>You are uploading file on Task : <?php echo $task_name; ?></h1> -->
        <div class="box">
            <h2>Upload a File</h2>
			<?php
            
                if (isset($_SESSION['uploadsuccess'])) {
                echo $_SESSION['uploadsuccess'];
                unset($_SESSION['uploadsuccess']);
                }
            ?>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="file" class="form-label">Select File</label>
                    <input type="file" class="form-control" name="file" id="file">
                </div>
                <button type="submit" class="btn btn-primary">Upload File</button>
            </form>
        </div>
    </div>
</body>
</html>
