<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound Main</title>
    </head>

    <body>
        <h1>Bughound Main</h1>
		<?php
			include 'auth/validate_user.php';	
			isLoggedIn();
		?>
        <script language=Javascript>
            function logOut() {
				//Expire all cookies
				document.cookie.split(";").forEach(function(c) { 
					document.cookie = c.replace(/^ +/, "").replace(/=.*/, 
						"=;expires=" + new Date().toUTCString() + ";path=/"); 
				});
				//Replace to login.php
                window.location.replace("./auth/login.php");
            }

			function editAreas() {
				window.location.replace("./area/area.php");
			}
			function editPrograms() {
				window.location.replace("./program/program.php");
			}
			function editEmployees() {
				window.location.replace("./employee/View_Employee.php");
			}

        </script>    
		<table>
			<tr><td>
				<input type="button" onclick="window.location.href = './report/bug_view.php';" value="Edit Bug", id="bug"/>	
			</td></tr>
			<?php
				if(isAdmin()) {
					echo " <tr><td>
						<input type='button' onclick='editAreas()' value='Edit Areas', id='bug'/>		
					</td></tr>";

					echo " <tr><td>
						<input type='button' onclick='editPrograms()' value='Edit Programs', id='bug'/>		
					</td></tr>";

					echo " <tr><td>
						<input type='button' onclick='editEmployees()' value='Edit Employees', id='bug'/>		
					</td></tr>";
				}
			?>
			<tr><td>
				<input type="button" onclick="logOut()" value="Log Out" id=logout/>
			</td></tr>
    </body>
</html>