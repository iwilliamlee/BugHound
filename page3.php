<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>View Names</title>
    </head>
    <body>
        <?php
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "employees");
			$query = "SELECT * FROM employees";
			$result = mysqli_query($con, $query);
            echo "<table border=1 ><th>ID</th><th>Name</th>\n";
            $none = 0;
            while($row=mysqli_fetch_row($result)) {
                $none=1;
                printf("<tr><td><A href='page4.php?employee_id={$row[0]}'><span class=\"linkline\">%d</span></a> </td><td>%s</td></tr>\n",$row[0],$row[1]);
            }
        ?>
        </table>
        <?php
            if($none==0)
		Echo "<h3>No matching records found.</h3>\n";
        ?>
        <p><INPUT type="button" value="Cancel" id=button1 name=button1 onclick="go_home()">
        <script language=Javascript>

            function go_home() {
                window.location.replace("index.php");
            }

</script>    
    </body>
</html>

