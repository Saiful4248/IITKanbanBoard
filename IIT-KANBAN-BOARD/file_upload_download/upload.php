<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf","txt","zip","docx","html","js","php","pptx","csv");
        if (!in_array($file_type, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF,TXT,ZIP,DOCX ,HTML,JS,PHP,PPTX,CSV and PDF files are allowed.";
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // File upload success, now store information in the database
                $filename = $_FILES["file"]["name"];
                $filesize = $_FILES["file"]["size"];
                $filetype = $_FILES["file"]["type"];

                // Database connection
                $db_host = "localhost";
                $db_user = "root";
                $db_pass = "";
                $db_name = "iitkanbanboard";

                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }


                if (isset($_SESSION['task_Id'])) {
                    $Task_Id = $_SESSION['task_Id'];
                  }
            
                  if (isset($_SESSION['project_Id'])) {
                    $Project_Id = $_SESSION['project_Id'];
                  }

               

                // Insert the file information into the database
                $sql = "INSERT INTO files (Task_Id,Project_Id,filename, filesize, filetype) VALUES ('$Task_Id','$Project_Id','$filename', $filesize, '$filetype')";

                if ($conn->query($sql) === TRUE) {
                    // echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded and the information has been stored in the database.";
                    $_SESSION['uploadsuccess']="File Uploaded Successfully";
                    header("Location: index.php");
                    exit;
                } else {
                    // echo "Sorry, there was an error uploading your file and storing information in the database: " . $conn->error;
                    $_SESSION['uploadsuccess']="File Upload Failed!";
                    header("Location: index.php");
                    exit;
                }

                $conn->close();
            } else {
                // echo "there was an error uploading your file";
                $_SESSION['uploadsuccess']="There was an error uploading your file!";
                header("Location: index.php");
                exit;
            }
        }
    } else {
        // echo "No file for upload";
        $_SESSION['uploadsuccess']="No file for upload!";
        header("Location: index.php");
        exit;
    }
}
?>

