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

            // include '../auth/validate_user.php';
            // isLoggedIn();
            
            
            // $updatePage;
            // $createPage;
        	
            
            // if(isAdmin()) {
            //     $updatePage = "Bug_Edit_Admin.php";
            //     $createPage = "Bug_Report_Admin.php";
            // }
            // else {
            //     $updatePage = "Bug_Edit_User.php";
            //     $createPage = "Bug_Report_User.php";
            // }


			$con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "Bughound");



            $queryCols = "SELECT bug_id, 
                problem_summary,
                program_name,
                report_type,
                severity,
                area_name,
                assignees.name,
                bug_status,
                priority,
                resolution,
                reportees.name,
                bug_date,
                resolve_date
            ";

            $queryJoin = " FROM bugs 
                INNER JOIN programs 
                ON bugs.program_id = programs.program_id
                INNER JOIN areas
                ON bugs.area_id = areas.area_id
                INNER JOIN employees as assignees
                ON bugs.assignee = assignees.employee_id
                INNER JOIN employees as reportees
                ON bugs.employee_id = reportees.employee_id ";

            $queryConditional;
            if(isset($_GET['program'])) {
                $search = $_GET['program'];
                $queryConditional = "  WHERE program_name LIKE '%$search%' ";
            }
            else if(isset($_GET['report_type'])) {
                $search = $_GET['report_type'];
                $queryConditional = "  WHERE report_type LIKE '%$search%' ";
            }
            else if(isset($_GET['severity'])) {
                $search = $_GET['severity'];
                $queryConditional = "  WHERE severity LIKE '%$search%' ";
            }
            else if(isset($_GET['area'])) {
                $search = $_GET['area'];
                $queryConditional = "  WHERE area_name LIKE '%$search%' ";
            }
            else if(isset($_GET['assigned'])) {
                $search = $_GET['assigned'];
                $queryConditional = "  WHERE assignees.name LIKE '%$search%' ";
            }
            else if(isset($_GET['status'])) {
                $search = $_GET['status'];
                $queryConditional = "  WHERE bug_status LIKE '%$search%' ";
            }
            else if(isset($_GET['priority'])) {
                $search = $_GET['priority'];
                $queryConditional = "  WHERE priority LIKE '%$search%' ";
            }
            else if(isset($_GET['resolution'])) {
                $search = $_GET['resolution'];
                $queryConditional = "  WHERE resolution LIKE '%$search%' ";
            }
            else if(isset($_GET['reported_by'])) {
                $search = $_GET['reported_by'];
                $queryConditional = "  WHERE reportees.name LIKE '%$search%' ";
            }
            else if(isset($_GET['report_date'])) {
                $search = $_GET['report_date'];
                $queryConditional = "  WHERE bug_date LIKE '%$search%' ";
            }
            else if(isset($_GET['resolved_by'])) {
                $search = $_GET['resolved_by'];
                $queryConditional = "  WHERE resolve_date LIKE '%$search%' ";
            }
            else {
                $queryConditional = "";
            }



            $query = $queryCols . $queryJoin . $queryConditional;

            if (!mysqli_query($con,$query))
            {
                echo("Error description: " . mysqli_error($con));
                return;
            }


            // $query = "SELECT * FROM bugs";
            $result = mysqli_query($con, $query);
            
            

            echo "<p><table border=1 >
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
                            <A href='$updatePage?bug_id={$row[0]}'>
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
                        $row[0],
                        $row[1],
                        $row[2],
                        $row[3],
                        $row[4],
                        $row[5],
                        $row[6],
                        $row[7],
                        $row[8],
                        $row[9],
                        $row[10],
                        $row[11],
                        $row[12]
                );
            }
        ?>



        </table>
        <?php
            if($none==0)
		Echo "<h3>No matching records found.</h3>\n";
        ?>
        <p><form action="../Database/output.php" method="post">
            <input type="hidden" name="bug" value="1">
            <input type="hidden" name="txt" value="1">
            <input type="hidden" name="queryCols" value="<?php echo htmlspecialchars($queryCols); ?>">
            <input type="hidden" name="queryJoin" value="<?php echo htmlspecialchars($queryJoin); ?>">
            <input type="hidden" name="queryConditional" value="<?php echo htmlspecialchars($queryConditional); ?>">
            <input type="submit" name="outputText" value="Output to XML">
        </form>

        <p><INPUT type="button" value="Create New Bug" id=button1 name=button1 onclick="create()">

        <p><INPUT type="button" value="Go Home" id=button1 name=button1 onclick="go_home()">
        <script language=Javascript>
            function create() {
                var reportPage='<?php echo $createPage;?>';
                window.location.replace("./" + reportPage);
            }
            function go_home() {
                window.location.replace("../index.php");
            }
        </script>    
    </body>
</html>