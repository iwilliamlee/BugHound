<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Updating Employee</title>
    </head>
    <body>
        <?php
			$id = $_GET['employee_id'];
			$name;
			$username;
			$password;
			$level;
			$con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "Bughound");
			$query = "SELECT user_name, password, user_level, name FROM employees WHERE employee_id = '$id' ";
            //echo $query;
            $none = 0;
			$result = mysqli_query($con, $query);
            while($row=mysqli_fetch_row($result)) {
                $none=1;
				$username = $row[0];
				$password = $row[1];
				$level = $row[2];
				$name = $row[3];
            }
		?>
		<form action="Updating_Employee_successful.php" method="post" onsubmit="return validate(this)">
            <table>
				<input type="hidden" name="ID" value="<?php echo htmlspecialchars($id); ?>">
				<tr><td>Name:</td><td><input type="Text" name="name" value="<?php echo htmlspecialchars($name); ?>"</td></tr>
                <tr><td>Username:</td><td><input type="Text" name="username" value="<?php echo htmlspecialchars($username); ?>"</td></tr>
                <tr><td>Password:</td><td><input type="Password" name="password" value="<?php echo htmlspecialchars($password); ?>"</td></tr>
				<tr><td>Userlevel:</td><td>
					<select type="number" name="userlevel" size=1 value="4">
					  <option value="1" <?php if($level == 1) { ?> selected="selected" <?php } ?> >1</option>
					  <option value="2" <?php if($level == 2) { ?> selected="selected" <?php } ?> >2</option>
					  <option value="3" <?php if($level == 3) { ?> selected="selected" <?php } ?> >3</option>
					  <option value="4" <?php if($level == 4) { ?> selected="selected" <?php } ?> >4</option>
					</select></td>
				</tr>
            </table>
            <input type="submit" name="submit" value="Next">
        </form>

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
        <p><INPUT type="button" value="Cancel" id=button1 name=button1 onclick="go_home()">
        <script language=Javascript>
            function go_home() {
                window.location.replace("index.php");
            }

</script>    
    </body>
</html>

