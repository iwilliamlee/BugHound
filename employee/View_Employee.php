<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound View Employee</title>
    </head>
    <body>
        <?php

            include '../auth/validate_user.php';	
            isLoggedIn();
			$con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "Bughound");
			$query = "SELECT * FROM employees";
			$result = mysqli_query($con, $query);
            echo "<table border=1 ><th>ID</th><th>Name</th>\n";
            $none = 0;
            while($row=mysqli_fetch_row($result)) {
                $none=1;
                printf(
                    "<tr><td><A href='Updating_Employee.php?employee_id={$row[0]}'>
                    <span class=\"linkline\">%d</span></a>
                    </td><td>%s</td></tr>\n",$row[0],$row[1]);
            }
        ?>
        </table>
        <?php
            if($none==0)
		Echo "<h3>No matching records found.</h3>\n";
        ?>
        <p><INPUT type="button" value="Create" id=button1 name=button1 onclick="create()"></p>
        <p><input type="submit" name="outputText" value="Output to XML" onclick="export_emp()"></p>

        <p><INPUT type="button" value="Cancel" id=button1 name=button1 onclick="go_home()"></p>
        <script language=Javascript>
            function create() {
                window.location.replace("./add_employee_page.php");
            }
            function go_home() {
                window.location.replace("../index.php");
            }
            function export_emp() {
                window.location.replace("./Export_All_Employee.php");
            }
        </script>    
    </body>
</html>

