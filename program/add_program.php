<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add a Program</title>
    </head>
    <body>
		<?php
			include '../validate_user.php';		
			isLoggedIn();
		?>
		
        <h1>Add a Program</h1>
        <form action="../add.php" method="post" onsubmit="return validate(this)">

            <table>
                <tr><td>Name:</td><td><input type="Text" name="program_name"</td></tr>
            </table>
            <table>
                <tr><td>Release:</td><td><input type="Number" name="release"</td></tr>
            </table>
            <input type="submit" name="submit" value="Submit">
			<input type="button" value="Cancel" onclick="window.location.href = 'program.php'">

        </form>

        <script language=Javascript>

            function validate(theform) {
                if(theform.name.value === ""){
                    alert ("Name field must contain characters");
                    return false;
                }
                if(theform.release.value === ""){
                    alert ("Release field must contain a number");
                    return false;
                }
            }

        </script>

    </body>

</html>