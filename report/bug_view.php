<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound View Bugs</title>
    </head>
    <body>
    <form action="bug_view.php" method="get" onsubmit="return validate(this)">
        <table>
            <tr>
                <td>Program:</td>
                <td><input type="Text" name="program" value="<?php  if(isset($_GET['program'])) echo htmlspecialchars($_GET['program']); ?>"</td>
                <td>Version:</td>
                <td><input type="Number" name="version""</td>
                <td>Release:</td><td><input type="Number" name="release"</td>
            </tr>
            <tr>
                <td>Report Type:</td>
                <td><input type="Text" name="report_type" value="<?php  if(isset($_GET['report_type'])) echo htmlspecialchars($_GET['report_type']); ?>"</td>
            </tr>
            <tr>
                <td>Severity:</td>
                <td><input type="Text" name="severity" value="<?php  if(isset($_GET['severity'])) echo htmlspecialchars($_GET['severity']); ?>"</td>
            </tr>
            <tr>
                <td>Area:</td>
                <td><input type="Text" name="area" value="<?php  if(isset($_GET['area'])) echo htmlspecialchars($_GET['area']); ?>"</td>
            </tr>
            <tr>
                <td>Assigned To:</td>
                <td><input type="Text" name="assigned" value="<?php  if(isset($_GET['assigned'])) echo htmlspecialchars($_GET['assigned']); ?>"</td>
            </tr>
            <!-- <tr>
                <td>Status:</td>
                <td><input type="Text" name="status" value="<?php  if(isset($_GET['status'])) echo htmlspecialchars($_GET['status']); ?>"</td>
            </tr> -->
            <tr>
                <td>Priority:</td>
                <td><input type="Text" name="priority" value="<?php  if(isset($_GET['priority'])) echo htmlspecialchars($_GET['priority']); ?>"</td>
            </tr>
            <tr>
                <td>Resolution:</td>
                <td><input type="Text" name="resolution" value="<?php  if(isset($_GET['resolution'])) echo htmlspecialchars($_GET['resolution']); ?>"</td>
            </tr>
            <tr>
                <td>Reported By:</td>
                <td><input type="Text" name="reported_by" value="<?php  if(isset($_GET['reported_by'])) echo htmlspecialchars($_GET['reported_by']); ?>"</td>
            </tr>

            <tr>
                <td>Report Date:</td>
                <td><input type="Text" name="report_date" value="<?php  if(isset($_GET['report_date'])) echo htmlspecialchars($_GET['report_date']); ?>"</td>
            </tr>
            <tr>
                <td>Resolved By:</td>
                <td><input type="Text" name="resolved_by" value="<?php  if(isset($_GET['resolved_by'])) echo htmlspecialchars($_GET['resolved_by']); ?>"</td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Search">
                <input type="button" value="reset" id=button1 name=button1 onclick="reload()"></td>

            </tr>
        </table>
    </form>

    <?php

        include '../auth/validate_user.php';
        isLoggedIn();
        
        
        $updatePage;
        $createPage;
        
        
        if(isAdmin()) {
            $updatePage = "Bug_Edit_Admin.php";
            $createPage = "Bug_Report_Admin.php";
        }
        else {
            $updatePage = "Bug_Edit_User.php";
            $createPage = "Bug_Report_User.php";
        }


        $con = mysqli_connect("localhost","root");
        mysqli_select_db($con, "Bughound");






        $queryCols = "SELECT 
            bug_id, 
            problem_summary,
            program_name,
            program_version,
            release_build,
            report_type,
            severity_name,
            area_name,
            assignees.name as Assignee,
            bug_status,
            priority_name,
            resolution_name,
            reportees.name,
            bug_date,
            resolve_date,
            problem,
            reproducible,
            suggested_fix,
            comments,
            resolution_version,
            resolvees.name as Resolvee,
            testees.name as Testee,
            test_date,
            deferred
        ";

        $queryJoin = " FROM bugs 
            LEFT JOIN programs 
            ON bugs.program_id = programs.program_id
            LEFT JOIN areas
            ON bugs.area_id = areas.area_id
            LEFT JOIN employees as assignees
            ON bugs.assignee = assignees.employee_id
            LEFT JOIN employees as reportees
            ON bugs.employee_id = reportees.employee_id
            LEFT JOIN employees as resolvees
            ON bugs.resolvee = resolvees.employee_id 
            LEFT JOIN employees as testees
            ON bugs.testee = testees.employee_id
            LEFT JOIN severity as severity_table
            ON bugs.severity = severity_table.severity_id
            LEFT JOIN resolution
            ON resolution = resolution_id
            LEFT JOIN priority
            ON priority = priority_id";
            
        $queryConditional = " WHERE ";
        if(isset($_GET['program'])) {
            $search = mysqli_real_escape_string($con, $_GET['program']);
            $queryConditional .= " program_name LIKE '%$search%' AND ";
        }
        if(isset($_GET['version'])) {
            $search = mysqli_real_escape_string($con, $_GET['version']);
            $queryConditional .= " program_version LIKE '%$search%' AND ";
        }
        if(isset($_GET['release'])) {
            $search = mysqli_real_escape_string($con, $_GET['release']);
            $queryConditional .= " release_build LIKE '%$search%' AND ";
        }
        if(isset($_GET['report_type'])) {
            $search = mysqli_real_escape_string($con, $_GET['report_type']);
            $queryConditional .= " report_type LIKE '%$search%' AND ";
        }
        if(isset($_GET['severity'])) {
            $search = mysqli_real_escape_string($con, $_GET['severity']);
            $queryConditional .= " severity_name LIKE '%$search%' AND ";
        }
        if(isset($_GET['area'])) {
            $search = mysqli_real_escape_string($con, $_GET['area']);
            $queryConditional .= " area_name LIKE '%$search%' AND ";
        }
        if(isset($_GET['assigned'])) {
            $search = mysqli_real_escape_string($con, $_GET['assigned']);
            $queryConditional .= " assignees.name LIKE '%$search%' AND ";
        }
        if(isset($_GET['priority'])) {
            $search = mysqli_real_escape_string($con, $_GET['priority']);
            $queryConditional .= " priority_name LIKE '%$search%' AND ";
        }
        if(isset($_GET['resolution'])) {
            $search = mysqli_real_escape_string($con, $_GET['resolution']);
            $queryConditional .= " resolution_name LIKE '%$search%' AND ";
        }
        if(isset($_GET['reported_by'])) {
            $search = mysqli_real_escape_string($con, $_GET['reported_by']);
            $queryConditional .= " reportees.name LIKE '%$search%' AND ";
        }
        if(isset($_GET['report_date'])) {
            $search = mysqli_real_escape_string($con, $_GET['report_date']);
            $queryConditional .= " bug_date LIKE '%$search%' AND ";
        }
        if(isset($_GET['resolved_by'])) {
            $search = mysqli_real_escape_string($con, $_GET['resolved_by']);
            $queryConditional .= " resolve_date LIKE '%$search%' AND ";
        }
        
        $queryConditional .= " bug_status LIKE 'open'";
        



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
            <th>Version</th>
            <th>Release</th>
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
                    $row[12],
                    $row[13],
                    $row[14]
            );
        }
    ?></table>

    <?php
        if($none==0)
        Echo "<h3>No matching records found.</h3>\n";
    ?>
    <p><form action="../Database/output.php" method="post">
        <input type="hidden" name="bug" value="1">
        <input type="hidden" name="query" value="<?php echo htmlspecialchars($query); ?>">
        <input type="submit" name="outputText" value="Output to XML and ASCII">
    </form>

    <p><INPUT type="button" value="Create New Bug" id=button1 name=button1 onclick="create()">

    <p><INPUT type="button" value="Go Home" id=button1 name=button1 onclick="go_home()">
    <script language=Javascript>
        function validate() {
            return true;
        }
        function create() {
            var reportPage='<?php echo $createPage;?>';
            window.location.replace("./" + reportPage);
        }
        function go_home() {
            window.location.replace("../index.php");
        }
        function reload() {
            window.location.replace("./bug_view.php");
        }
    </script>    
    </body>
</html>