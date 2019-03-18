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
        </script>    
		<table>
			<tr><td>
				<input type="button" onclick="window.location.href = './report/bug_view.php';" value="Edit Bug", id="bug"/>	
			</td></tr>
<tr><td>
				<input type="button" onclick="window.location.href = './area/area.php';" value="Edit Areas", id="bug"/>		
			</td></tr>
			<tr><td>
				<input type="button" onclick="window.location.href = './program/program.php';" value="Edit Programs", id="bug"/>		
			</td></tr>
			<tr><td>
				<input type="button" onclick="window.location.href = './employee/View_Employee.php';" value="Edit Employees", id="bug"/>		
			</td></tr>


			<tr><td>
				<input type="button" onclick="logOut()" value="Log Out" id=logout/>
			</td></tr>
    </body>
</html>