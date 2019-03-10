<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add a Employee</title>
    </head>
    <body>
        <h1>Add a Employee</h1>
        <form action="add.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>name:</td><td><input type="Text" name="name"</td></tr>
                <tr><td>user name:</td><td><input type="Text" name="username"</td></tr> 
                <tr><td>password:</td><td><input type="Text" name="password"</td></tr> 
				<tr><td>user level:</td><td><select name="user_level">
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				</select></td></tr>
				
            </table>
            <input type="submit" name="submit" value="Submit">			<input type="reset" name="reset" value="Reset">			<input type="button" value="Cancel" onclick="window.location.href = 'employee.php'">
        </form>
        <script language=Javascript>
            function validate(theform) {
                if(theform.name.value === ""){
                    alert ("name field must contain characters");
                    return false;
                }
                if(theform.username.value === ""){
                    alert ("username field must contain characters");
                    return false;
                }
				if(theform.password.value === ""){
                    alert ("password field must contain characters");
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
