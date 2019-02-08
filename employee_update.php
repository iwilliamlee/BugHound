<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CECS 544 Lab 4</title>
    </head>
    <body>
        <h1>Update an Employee</h1>
        <form action="page2.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Name</td><td><input type="Text" name="name"</td></tr>
                <tr><td>User Name</td><td><input type="Text" name="user_name"</td></tr>    
                <tr><td>Password</td><td><input type="Text" name="password"</td></tr>    
                <tr>
                    <td>User Level</td>
                    <td>
                        <input type="number" name="user_level" min="1" max="5" step="1" value="1">
                    </td>
                </tr>        
            </table>
            <input type="submit" name="submit" value="Next">
            <input type="submit" name="cancel" value="Cancel">
        </form>
        <p>
            <h3>
                <A href="page3.php"><span class=\"linkline\">View Names</span></a>
            </h3>
        </p>
        <script language=Javascript>
            function validate(theform) {
                if(theform.name.value === ""){
                    alert ("Name field must contain characters");
                    return false;
                }
                if(theform.user_name.value === ""){
                    alert ("User name field must contain characters");
                    return false;
                }
                if(theform.password.value === ""){
                    alert ("Password field must contain characters");
                    return false;
                }
                return true;
            }
</script>
    </body>
</html>
