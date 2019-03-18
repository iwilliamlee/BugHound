<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <title>Bughound Login</title>
    </head>

    <body>    
        <h1>Bughound Login</h1>
        <form action="login_check.php" method="post" onsubmit="return validate(this)">

            <table>
                <tr><td>Username:</td><td><input type="Text" name="username"</td></tr> 
                <tr><td>Password:</td><td><input type="password" name="password"</td></tr> 
            </table>

            <input type="submit" name="Submit" value="Submit">

			<input type="reset" name="Reset" value="Reset">

        </form>

        <script language=Javascript>

            function validate(theform) {

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