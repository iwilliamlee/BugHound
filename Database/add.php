

<?php
	
	if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password'])){
		$con = mysqli_connect("localhost","root");
		mysqli_select_db($con, "Bughound");
		$name = mysqli_real_escape_string($con, $_POST['name']);
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$level = $_POST['user_level'];

		$query = "INSERT INTO employees (name, password, user_name, user_level) VALUES ('".$name."','".$password."', '".$username."', '".$level."')";

		mysqli_query($con, $query);
		header("Location: ../employee/employee.php");
		
		die();	
	}

	//If it is a post to program
	if(isset($_POST['program_name'])){
		$con = mysqli_connect("localhost","root");
		mysqli_select_db($con, "Bughound");
		$name = mysqli_real_escape_string($con, $_POST['program_name']);
		$version = mysqli_real_escape_string($con, $_POST['version']);
		$release = mysqli_real_escape_string($con, $_POST['release']);

		$query_check = "SELECT * FROM programs WHERE program_name = '$name' AND release_build= '$release' AND program_version = '$version' ";
		$result = mysqli_query($con, $query_check);
		if (mysqli_num_rows($result) != 0){
			echo "<SCRIPT type='text/javascript'>
				alert('Program Already In Database');
				window.location.replace('../program/program.php');
				</SCRIPT>";	
		}	
		else {
			$query = "INSERT INTO programs (program_name, program_version, release_build) VALUES ('$name','$version','$release')";
			mysqli_query($con, $query);
			header("Location: ../program/program.php");	
		}		
	}	
	
	if(isset($_POST['area_name'])){
		$con = mysqli_connect("localhost","root");
		mysqli_select_db($con, "Bughound");
		$name = mysqli_real_escape_string($con, $_POST['area_name']);
		$program_id = mysqli_real_escape_string($con, $_POST['program_id']);

		$query_check = "SELECT * FROM areas WHERE area_name = '$name' AND program_id = '$program_id'";
		$result = mysqli_query($con, $query_check);

		if (mysqli_num_rows($result) != 0){
			echo "<SCRIPT type='text/javascript'>
				alert('Area Already In Database');
				window.location.replace('../area/area.php');
				</SCRIPT>";	
		}	
		else {
			$query = "INSERT INTO areas (area_name, program_id) VALUES ('$name','$program_id')";
			mysqli_query($con, $query);
			header("Location: ../area/area.php");		
		}		
		die();	
	}
	
?>

