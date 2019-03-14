<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Area</title>

	</head>
	<body>
		<h1> Area Page </h1>
		<?php
			include '../auth/validate_user.php';		
			isLoggedIn();
			
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "Bughound");
			$query = "SELECT * FROM areas";
			$result = mysqli_query($con, $query);
			 
			if (mysqli_num_rows($result) == 0){
				echo "<h1> No Areas Added</h1>";
			}
			
			else 
			{
				echo "<table border=1 id = 'table'><th>Area ID</th><th>Name</th>\n";
				while($row=mysqli_fetch_array($result)) {
					printf("<tr>
								<td>
									<A href='update_area.php?area_id={$row[0]}'>
									<span class=\"linkline\">%d</span></a>
								</td>
								<td>%s</td>
							</tr>\n",
							$row['area_id'],
							$row['area_name']
					);
				}
			}
		?>
		</table>
			
		<INPUT type="button" value="Create" id=create onclick="window.location.href = './add_area.php'">
		<INPUT type="button" value="Done" id=done onclick="window.location.href = '../index.php'">
		
	

	</body>
</html>