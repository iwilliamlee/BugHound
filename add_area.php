<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add an Area</title>
    </head>
    <body>
		<?php
			include 'validate_user.php';		
			isLoggedIn();
		?>
		
        <h1>Add an Area</h1>
        <form action="add.php" method="post" onsubmit="return validate(this)">

            <table>
                <tr><td>Name:</td><td><input type="Text" name="area_name"</td></tr>
            </table>

            <input type="submit" name="submit" value="Submit">
			<input type="reset" name="reset" value="Reset">
			<input type="button" value="Cancel" onclick="window.location.href = 'area.php'">

        </form>

        <script language=Javascript>

            function validate(theform) {
                if(theform.area_name.value === ""){
                    alert ("Name field must contain characters");
                    return false;

        </script>

    </body>

</html>