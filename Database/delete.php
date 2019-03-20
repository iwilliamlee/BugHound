

<?php
	include '../auth/validate_user.php';		
	isLoggedIn();

	if(isset($_POST['employee_id'])){
		$id = $_POST['employee_id'];
		$minLevel = 2;

		//If user is trying to delete himself, do not let him
		if($id == $_SESSION["employee_id"]) {
			echo "
				<SCRIPT type='text/javascript'>
					alert('Cannot delete yourself');
					window.location.replace('../employee/Updating_Employee.php?employee_id=$id');
				</SCRIPT>";	
			return;
		}

		$con = mysqli_connect("localhost","root");
		mysqli_select_db($con, "Bughound");

		$query_check = "SELECT * FROM `employees` WHERE `employee_id` = '".$id."'";
		
		$result = mysqli_query($con, $query_check);

		if (mysqli_num_rows($result) == 0){
			echo "
				<SCRIPT type='text/javascript'>
					alert('Employee not in database);
					window.location.replace('../employee/View_Employee.php');
				</SCRIPT>";	
		}	
		else if(!isValidLevel($minLevel)) {
			echo "
				<SCRIPT type='text/javascript'>
					window.location.replace('../employee/Updating_Employee.php?employee_id=$id');
				</SCRIPT>";	
		}
		else {
			$query = "DELETE FROM `employees` WHERE `employee_id` = '".$id."'";
			if (!mysqli_query($con, $query )){
				echo("Error description: " . mysqli_error($con));
			}
			else {
				header("Location: ../employee/View_Employee.php");	
			}	
		}		
		die();	
		mysqli_close($con);
	}

	if(isset($_POST['program_id'])){
		$id = $_POST['program_id'];
		$minLevel = 2;

		$con = mysqli_connect("localhost","root");
		mysqli_select_db($con, "Bughound");

		$query_check = "SELECT * FROM `programs` WHERE `program_id` = '".$id."'";
		$result = mysqli_query($con, $query_check);

		if (mysqli_num_rows($result) == 0){
			echo "<SCRIPT type='text/javascript'>
				alert('Program not in database);
				window.location.replace('../program/program.php');
				</SCRIPT>";	
		}	
		else if(!isValidLevel($minLevel)) {
			echo "<SCRIPT type='text/javascript'>
				window.location.replace('../program/update_program.php?program_id=$id');
				</SCRIPT>";	
		}
		else {
			$query = "DELETE FROM `programs` WHERE `program_id` = '".$id."'";
			if (!mysqli_query($con, $query )){
				echo("Error description: " . mysqli_error($con));
			}
			else {
				header("Location: ../program/program.php");	
			}	
		}		
		die();	
		mysqli_close($con);
	}
	

	if(isset($_POST['area_id'])){
		$id = $_POST['area_id'];
		$minLevel = 2;

		$con = mysqli_connect("localhost","root");
		mysqli_select_db($con, "Bughound");

		$query_check = "SELECT * FROM `areas` WHERE `area_id` = '".$id."'";
		$result = mysqli_query($con, $query_check);

		if (mysqli_num_rows($result) == 0){
			echo "<SCRIPT type='text/javascript'>
				alert('Area not in database);
				window.location.replace('../area/area.php');
				</SCRIPT>";	
		}	
		else if(!isValidLevel($minLevel)) {
			echo "<SCRIPT type='text/javascript'>
				window.location.replace('../area/update_area.php?area_id=$id');
				</SCRIPT>";	
		}
		else {
			$query = "DELETE FROM `areas` WHERE `area_id` = '".$id."'";
			if (!mysqli_query($con, $query )){
				echo("Error description: " . mysqli_error($con));
			}
			else {
				header("Location: ../area/area.php");	
			}	
		}		
		die();	
		mysqli_close($con);
	}

?>

