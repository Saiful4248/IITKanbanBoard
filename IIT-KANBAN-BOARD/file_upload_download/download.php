<?php
session_start();

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "iitkanbanboard";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['project_id']) && isset($_GET['task_id'])) {
    $project_Id = $_GET['project_id'];
    $task_id = $_GET['task_id'];

    $_SESSION['project_Id']=$project_Id;
    $_SESSION['task_Id']=$task_id;

}

  if (isset($_SESSION['task_Id'])) {
    $Task_Id = $_SESSION['task_Id'];
  }

  if (isset($_SESSION['project_Id'])) {
    $Project_Id = $_SESSION['project_Id'];
  }

  if (isset($_GET['task_name'])) {
    $task_name = $_GET['task_name'];
}

$sql = "SELECT *FROM files WHERE Project_Id= '$Project_Id' AND Task_Id='$Task_Id' ";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uploaded files</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
        <h1>You are Downloading file on Task : <?php echo $task_name; ?></h1>

    <div class="container mt-5">
        <h2>Uploaded Files</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>File Size</th>
                    <th>File Type</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display the uploaded files and download links
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $file_path = "uploads/" . $row['filename'];
                ?>
                        <tr>
                            <td><?php echo $row['filename']; ?></td>
                            <td><?php echo $row['filesize']; ?> bytes</td>
                            <td><?php echo $row['filetype']; ?></td>
                            <td><a href="<?php echo $file_path; ?>" class="btn btn-primary" download>Download</a></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4">No files uploaded yet.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>