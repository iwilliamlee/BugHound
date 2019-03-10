<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Program</title>
	</head>
	<body>
		<h1> Program Page </h1>
		<?php
			include 'validate_user.php';		
			isLoggedIn();
			
			$con = mysqli_connect("localhost","root","","bug_hound"); 
			mysqli_select_db($con, "bug_hound");
			$query = "SELECT * FROM programs";
			$result = mysqli_query($con, $query);
			
			if (mysqli_num_rows($result) == 0){
				echo "<h1> No Programs Added</h1>";
			}
			
			else 
			{
				echo "<table border=1 id = 'table'><th>Program ID</th><th>Name</th><th>Release</th><th>Version</th>\n";
				while($row=mysqli_fetch_array($result)) {
					printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row['program_id'],$row['name'],$row['release_build'],$row['version']);
				}
			}
		?>
		</table>
			
		<INPUT type="button" value="Create" id=create onclick="window.location.href = 'add_program.php'" >
		<form action="search.php" method="post">
			<button type="submit" value="Program" name="type">Update</button>
		</form>
		<INPUT type="button" value="Done" id=done onclick="window.location.href = 'main.php'">
		
	</body>
</html>