<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Home Page</title>
    </head>
    <body>
        <h1>Search Bug</h1>
        
        <table>
            <tr>
                <form action="bug_search.php" method="get" onsubmit="return validate(this)">
                    <td>Program:</td>
                    <td><input type="Text" name="program" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="bug_search.php" method="post" onsubmit="return validate(this)">
                    <td>Report Type:</td>
                    <td><input type="Text" name="search" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="bug_search.php" method="post" onsubmit="return validate(this)">
                    <td>Severity:</td>
                    <td><input type="Text" name="search" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="bug_search.php" method="post" onsubmit="return validate(this)">
                    <td>Area:</td>
                    <td><input type="Text" name="search" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="bug_search.php" method="post" onsubmit="return validate(this)">
                    <td>Assigned To:</td>
                    <td><input type="Text" name="search" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="bug_search.php" method="post" onsubmit="return validate(this)">
                    <td>Status:</td>
                    <td><input type="Text" name="search" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="bug_search.php" method="post" onsubmit="return validate(this)">
                    <td>Priority:</td>
                    <td><input type="Text" name="search" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="bug_search.php" method="post" onsubmit="return validate(this)">
                    <td>Resolution:</td>
                    <td><input type="Text" name="search" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="bug_search.php" method="post" onsubmit="return validate(this)">
                    <td>Reported By:</td>
                    <td><input type="Text" name="search" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="bug_search.php" method="post" onsubmit="return validate(this)">
                    <td>Report Date:</td>
                    <td><input type="Text" name="search" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="bug_search.php" method="post" onsubmit="return validate(this)">
                    <td>Resolved By:</td>
                    <td><input type="Text" name="search" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
        </table>

        <?php
            include '../auth/validate_user.php';	
            isLoggedIn();
			$con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "Bughound");

            $query;
            if(isset($_GET['program'])) {
                $search = $_GET['program'];
                $query = "SELECT * FROM employees WHERE name LIKE '%$search%' ";
            }
            else if(isset($_GET['report_type'])) {
                $query = "SELECT * FROM employees";
            }
            else if(isset($_GET['severity'])) {
                $query = "SELECT * FROM employees";
            }
            else if(isset($_GET['area'])) {
                $query = "SELECT * FROM employees";
            }
            else if(isset($_GET['assign'])) {
                $query = "SELECT * FROM employees";
            }
            else if(isset($_GET['status'])) {
                $query = "SELECT * FROM employees";
            }
            else if(isset($_GET['priority'])) {
                $query = "SELECT * FROM employees";
            }
            else if(isset($_GET['resolution'])) {
                $query = "SELECT * FROM employees";
            }
            else if(isset($_GET['reported_by'])) {
                $query = "SELECT * FROM employees";
            }
            else if(isset($_GET['report_date'])) {
                $query = "SELECT * FROM employees";
            }
            else if(isset($_GET['resolved_by'])) {
                $query = "SELECT * FROM employees";
            }
            else {
                $query = "SELECT * FROM employees";
            }

			
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


        <script language=Javascript>
            function validate(theform) {
                if(theform.search.value === ""){
                    alert ("Search field must contain characters");
                    return false;
                }
                return true;
            }
		</script>
    </body>
</html>
