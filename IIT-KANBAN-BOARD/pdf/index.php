<?php
include("config.php");
?>
<html>
<head>
	<title>How to Generate PDF From MYSQL Using PHP</title>
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
</head>
<body>
	<div class="container">
		<div>&nbsp;</div>
		<div class="  d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-success">Generate Pdf</h6>
			<div class="card-tools" style="float: right;">
				<a href="genratepdf.php" target="_blank" class="btn btn-sm btn-primary">Generate PDF</a>
			</div>
		</div>
		<div>&nbsp;</div>
		<table class="table table-bordered">
			<tr>
				<td style="font-weight:bold;">Task_Name</td>
				<td style="font-weight:bold;">Task_Description</td>
				<td style="font-weight:bold;">Assign_Member</td>
				<td style="font-weight:bold;">Due_Date</td>
			</tr>
			<?php 


			if (isset($_GET['project_id']) && isset($_GET['project_name'])) {
				$project_id = $_GET['project_id'];
				$project_name = $_GET['project_name'];

				$_SESSION['project_Id']=$project_id;
				$_SESSION['project_name']=$project_name;

			} else {
				echo "Missing parameters in the URL.";
			}

				if(isset($_SESSION['project_name'])) {
				$Project_Name = $_SESSION['project_name'];
			}

			
			if (isset($_SESSION['project_Id'])) {
				$Project_Id = $_SESSION['project_Id'];
			}

			$sql = "SELECT * from  tasks Where Project_Id=$Project_Id";
			$query = $dbh -> prepare($sql);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
				foreach($results as $row) 
				{ 
					?>

					<tr>
						<td><?php echo htmlentities($row->Task_Name);?></td>
						<td><?php echo htmlentities($row->Task_Description);?></td>
						<td><?php echo htmlentities($row->Assign_Member);?></td>
						<td><?php  echo htmlentities(date("d-m-Y", strtotime($row->Due_Date)));?></td>
					</tr>

					<?php
				} 
			}
			?>
		</table>
	</div>
</body>
</html>