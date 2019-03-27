

<?php
	include '../auth/validate_user.php';		
	isLoggedIn();


	if(isset($_GET['program_id'])){
		$id = $_GET['program_id'];
		$minLevel = 2;

		$con = mysqli_connect("localhost","root");
		mysqli_select_db($con, "Bughound");

		$query_check = "SELECT * 
			FROM areas 
			INNER JOIN programs ON areas.program_id = programs.program_id  
			WHERE areas.program_id = $id
			ORDER BY areas.area_id";
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
			if (!mysqli_query($con, $query_check)){
				echo("Error description: " . mysqli_error($con));
			}
			else {
				while($row=mysqli_fetch_array($result)) {
					$rows = array();
					while($r = mysqli_fetch_row($result)) {
						$rows[] = $r;
					}
					print json_encode($rows);

					// printf("<tr>
					// 			<td>
					// 				<A href='update_area.php?area_id={$row[0]}'>
					// 				<span class=\"linkline\">%d</span></a>
					// 			</td>
					// 			<td>%s</td>
					// 			<td>%s</td>
					// 		</tr>\n",
					// 		$row['area_id'],
					// 		$row['area_name'],
					// 		$row['program_name'] . " v" . $row['program_version'] 
					// );
				}
			}	
		}		
		// die();	
	}
	

?>

