<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Home Page</title>
    </head>
    <body>
        <h1>BugHound Employee</h1>
        <form action="Adding_Employee.php" method="post" onsubmit="return validate(this)">
            <table>
				<tr><td>Name:</td><td>
                    <input type="Text" name="name"</td></tr>
                <tr><td>Username:</td><td>
                    <input type="Text" name="username"</td></tr>
                <tr><td>Password:</td><td>
                    <input type="Password" name="password"</td></tr>
				<tr><td>Userlevel:</td><td>
					<select type="number" name="userlevel" size=1>
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					</select></td>
				</tr>
            </table>
            <input type="submit" name="submit" value="Next">
            <input type="submit" name="cancel" value="Cancel">
        </form>
		<p>
			<h3>
				<A href="View_Employee.php"><span class=\"linkline\">View Names</span></a> 
			</h3>
		</p>

        <script language=Javascript>
            function validate(theform) {
                if(theform.name.value === ""){
                    alert ("First name field must contain characters");
                    return false;
                }
                if(theform.username.value === ""){
                    alert ("Last name field must contain characters");
                    return false;
                }
				if(theform.password.value === ""){
                    alert ("First name field must contain characters");
                    return false;
                }
				if(theform.userlevel.value === ""){
                    alert ("First name field must contain characters");
                    return false;
                }
				if(theform.name.value === ""){
                    alert ("First name field must contain characters");
                    return false;
                }
                return true;
            }
		</script>
    </body>
</html>
