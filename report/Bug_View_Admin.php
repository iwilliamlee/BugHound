<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound View Bugs</title>
    </head>
    <body>

    <table>
            <tr>
                <form action="Bug_View_Admin.php" method="get" onsubmit="return validate(this)">
                    <td>Program:</td>
                    <td><input type="Text" name="program" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="Bug_View_Admin.php" method="get" onsubmit="return validate(this)">
                    <td>Report Type:</td>
                    <td><input type="Text" name="report_type" value="<?php  if(isset($_GET['report_type'])) echo htmlspecialchars($_GET['report_type']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="Bug_View_Admin.php" method="get" onsubmit="return validate(this)">
                    <td>Severity:</td>
                    <td><input type="Text" name="severity" value="<?php  if(isset($_GET['severity'])) echo htmlspecialchars($_GET['severity']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="Bug_View_Admin.php" method="get" onsubmit="return validate(this)">
                    <td>Area:</td>
                    <td><input type="Text" name="area" value="<?php  if(isset($_GET['area'])) echo htmlspecialchars($_GET['area']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="Bug_View_Admin.php" method="get" onsubmit="return validate(this)">
                    <td>Assigned To:</td>
                    <td><input type="Text" name="assigned" value="<?php  if(isset($_GET['assigned'])) echo htmlspecialchars($_GET['assigned']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="Bug_View_Admin.php" method="get" onsubmit="return validate(this)">
                    <td>Status:</td>
                    <td><input type="Text" name="status" value="<?php  if(isset($_GET['status'])) echo htmlspecialchars($_GET['status']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="Bug_View_Admin.php" method="get" onsubmit="return validate(this)">
                    <td>Priority:</td>
                    <td><input type="Text" name="priority" value="<?php  if(isset($_GET['priority'])) echo htmlspecialchars($_GET['priority']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="Bug_View_Admin.php" method="get" onsubmit="return validate(this)">
                    <td>Resolution:</td>
                    <td><input type="Text" name="resolution" value="<?php  if(isset($_GET['resolution'])) echo htmlspecialchars($_GET['resolution']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="Bug_View_Admin.php" method="get" onsubmit="return validate(this)">
                    <td>Reported By:</td>
                    <td><input type="Text" name="reported_by" value="<?php  if(isset($_GET['reported_by'])) echo htmlspecialchars($_GET['reported_by']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="Bug_View_Admin.php" method="get" onsubmit="return validate(this)">
                    <td>Report Date:</td>
                    <td><input type="Text" name="report_date" value="<?php  if(isset($_GET['report_date'])) echo htmlspecialchars($_GET['report_date']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
            <tr>
                <form action="Bug_View_Admin.php" method="get" onsubmit="return validate(this)">
                    <td>Resolved By:</td>
                    <td><input type="Text" name="resolved_by" value="<?php  if(isset($_GET['resolved_by'])) echo htmlspecialchars($_GET['resolved_by']); ?>"</td>
                    <td><input type="submit" name="submit" value="Search"></td>
                </form>
            </tr>
        </table>



        <?php
			$con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "Bughound");



            
            $query;
            if(isset($_GET['program'])) {
                $search = $_GET['program'];
                $query = "SELECT * FROM bugs WHERE program_id LIKE '%$search%' ";
            }
            else if(isset($_GET['report_type'])) {
                $search = $_GET['report_type'];
                $query = "SELECT * FROM bugs WHERE report_type LIKE '%$search%' ";
            }
            else if(isset($_GET['severity'])) {
                $search = $_GET['severity'];
                $query = "SELECT * FROM bugs WHERE severity LIKE '%$search%' ";
            }
            else if(isset($_GET['area'])) {
                $search = $_GET['area'];
                $query = "SELECT * FROM bugs WHERE area_id LIKE '%$search%' ";
            }
            else if(isset($_GET['assigned'])) {
                $search = $_GET['assigned'];
                $query = "SELECT * FROM bugs WHERE assignee LIKE '%$search%' ";
            }
            else if(isset($_GET['status'])) {
                $search = $_GET['status'];
                $query = "SELECT * FROM bugs WHERE bug_status LIKE '%$search%' ";
            }
            else if(isset($_GET['priority'])) {
                $search = $_GET['priority'];
                $query = "SELECT * FROM bugs WHERE priority LIKE '%$search%' ";
            }
            else if(isset($_GET['resolution'])) {
                $search = $_GET['resolution'];
                $query = "SELECT * FROM bugs WHERE resolution LIKE '%$search%' ";
            }
            else if(isset($_GET['reported_by'])) {
                $search = $_GET['reported_by'];
                $query = "SELECT * FROM bugs WHERE employee_id LIKE '%$search%' ";
            }
            else if(isset($_GET['report_date'])) {
                $search = $_GET['report_date'];
                $query = "SELECT * FROM bugs WHERE bug_date LIKE '%$search%' ";
            }
            else if(isset($_GET['resolved_by'])) {
                $search = $_GET['resolved_by'];
                $query = "SELECT * FROM bugs WHERE resolve_date LIKE '%$search%' ";
            }
            else {
                $query = "SELECT * FROM bugs";
            }

            if (!mysqli_query($con,$query))
            {
                echo("Error description: " . mysqli_error($con));
                return;
            }
            // $query = "SELECT * FROM bugs";
			$result = mysqli_query($con, $query);
            echo "<table border=1 >
                <th>ID</th>
                <th>Problem</th>
                <th>Program</th>
                <th>Report Type</th>
                <th>Severity</th>
                <th>Functional Area</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Resolution</th>
                <th>Reported By</th>
                <th>Report D<ate/th>
                <th>Resolved Date</th>\n";

            $none = 0;
            while($row=mysqli_fetch_array($result)) {
                $none=1;
                printf(
                    "<tr>
                        <td>
                            <A href='Bug_Edit_Admin.php?bug_id={$row['bug_id']}'>
                            <span class=\"linkline\">%d</span></a>
                        </td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                    </tr>\n",
                        $row['bug_id'],
                        $row['problem_summary'],
                        $row['program_id'],
                        $row['report_type'],
                        $row['severity'],
                        $row['area_id'],
                        $row['assignee'],
                        $row['bug_status'],
                        $row['priority'],
                        $row['resolution'],
                        $row['employee_id'],
                        $row['bug_date'],
                        $row['resolve_date']
                );
            }
        ?>



        </table>
        <?php
            if($none==0)
		Echo "<h3>No matching records found.</h3>\n";
        ?>
        <p><INPUT type="button" value="Create" id=button1 name=button1 onclick="create()">

        <p><INPUT type="button" value="Cancel" id=button1 name=button1 onclick="go_home()">
        <script language=Javascript>
            function create() {
                window.location.replace("./bug_report.php");
            }
            function go_home() {
                window.location.replace("../index.php");
            }
        </script>    
    </body>
</html>