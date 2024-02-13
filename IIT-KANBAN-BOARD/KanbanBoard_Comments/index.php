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

	  if (isset($_GET['task_name'])) {
		$task_name = $_GET['task_name'];
	}

?>



<?php 
include('header.php');
?>
<title>IIT Kanban Board</title>
<script src="js/comments.js"></script>
<?php include('container.php');?>
	<div class="container">		
		<h2><strong>You are Commenting on Task :</strong> <?php echo $task_name; ?></h2>
			
		<br>		
		<form method="POST" id="commentForm">
			<div class="form-group">
				<input type="text" name="name" id="name" class="form-control" value="<?php echo $User_Name; ?>" readonly />
			</div>
			<div class="form-group">
				<textarea name="comment" id="comment" class="form-control" placeholder="Enter Comment" rows="5" required></textarea>
			</div>
			<span id="message"></span>
			<br>
			<div class="form-group">
				<input type="hidden" name="commentId" id="commentId" value="0" />
				<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Post Comment" />
				<input type="submit" name="reset" id="reset" class="btn btn-primary" value="Post Comment" />
			</div>
		</form>		
		<br>
		<div id="showComments"></div>   
</div>	
<?php include('footer.php');?>


