<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound Main</title>
    </head>

    <body>
        <h1>Bughound Main</h1>

		<table>
			<tr><td>
				<input type="button" onclick="window.location.href = './report/Bug_Report.php';" value="Submit Bug", id="bug"/>	
			</td></tr>
			<tr><td>
				<input type="button" onclick="window.location.href = './report/Bug_View.php';" value="View Bug", id="bug"/>	
			</td></tr>
			<tr><td>
				<input type="button" onclick="window.location.href = './employee/View_Employee.php';" value="Edit Employees", id="bug"/>		
			</td></tr>
			<tr><td>
				<input type="button" onclick="window.location.href = './program/program.php';" value="Edit Programs", id="bug"/>		
			</td></tr>
			<tr><td>
				<input type="button" onclick="window.location.href = './area/area.php';" value="Edit Areas", id="bug"/>		
			</td></tr>
			<tr><td>
				<input type="button" onclick="window.location.href = 'db_maintenance.php';" value="Database Maintenance" id="db"/>
			</td></tr>


		<?php
			include 'auth/validate_user.php';		
			isLoggedIn();
			
			$valid_level =  isValidLevel(3);
			if(!$valid_level) {
				echo "<SCRIPT type='text/javascript'>
				var x = document.getElementById('db');
				x.style.display = 'none';
				</SCRIPT>";			
			}
		?>
    </body>
</html>