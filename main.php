<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound Main</title>
    </head>

    <body>
        <h1>Bughound Main</h1>
        <form>

            <input type="button" onclick="window.location.href = 'bug_form.php';" value="Submit Bug", id="bug"/>
			<input type="button" onclick="window.location.href = 'db_maintenance.php';" value="Database Maintenance" id="db"/>
        </form>

		<?php
			include 'validate_user.php';		
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