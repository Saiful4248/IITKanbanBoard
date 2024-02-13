<?php
session_start();

include_once("db_connect.php");
if(!empty($_POST["name"]) && !empty($_POST["comment"])){

	if (isset($_SESSION['task_Id'])) {
		$Task_Id = $_SESSION['task_Id'];
	  }

	  if (isset($_SESSION['project_Id'])) {
		$Project_Id = $_SESSION['project_Id'];
	  }
	$insertComments = "INSERT INTO comment (parent_id, comment, sender,Task_Id,Project_Id) VALUES ('".$_POST["commentId"]."', '".$_POST["comment"]."', '".$_POST["name"]."','$Task_Id','$Project_Id')";
	mysqli_query($conn, $insertComments) or die("database error: ". mysqli_error($conn));	
	$message = '<label class="text-success">Comment posted Successfully.</label>';
	$status = array(
		'error'  => 0,
		'message' => $message
	);	
} else {
	$message = '<label class="text-danger">Error: Comment not posted.</label>';
	$status = array(
		'error'  => 1,
		'message' => $message
	);	
}
echo json_encode($status);
?>