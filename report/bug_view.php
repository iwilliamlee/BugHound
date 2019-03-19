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
                <td><input type="submit" name="submit" value="Search"></td>
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
            
        $queryConditional = " WHERE ";
        if(isset($_GET['program'])) {
            $search = $_GET['program'];
            $queryConditional .= " program_name LIKE '%$search%' AND ";
        }
        if(isset($_GET['report_type'])) {
            $search = $_GET['report_type'];
            $queryConditional .= " report_type LIKE '%$search%' AND ";
        }
        if(isset($_GET['severity'])) {
            $search = $_GET['severity'];
            $queryConditional .= " severity LIKE '%$search%' AND ";
        }
        if(isset($_GET['area'])) {
            $search = $_GET['area'];
            $queryConditional .= " area_name LIKE '%$search%' AND ";
        }
        if(isset($_GET['assigned'])) {
            $search = $_GET['assigned'];
            $queryConditional .= " assignees.name LIKE '%$search%' AND ";
        }
        if(isset($_GET['priority'])) {
            $search = $_GET['priority'];
            $queryConditional .= " priority LIKE '%$search%' AND ";
        }
        if(isset($_GET['resolution'])) {
            $search = $_GET['resolution'];
            $queryConditional .= " resolution LIKE '%$search%' AND ";
        }
        if(isset($_GET['reported_by'])) {
            $search = $_GET['reported_by'];
            $queryConditional .= " reportees.name LIKE '%$search%' AND ";
        }
        if(isset($_GET['report_date'])) {
            $search = $_GET['report_date'];
            $queryConditional .= " bug_date LIKE '%$search%' AND ";
        }
        if(isset($_GET['resolved_by'])) {
            $search = $_GET['resolved_by'];
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
    ?></table>

    <?php
        if($none==0)
        Echo "<h3>No matching records found.</h3>\n";
    ?>
    <p><form action="../Database/output.php" method="post">
        <input type="hidden" name="bug" value="1">
        <input type="hidden" name="query" value="<?php echo htmlspecialchars($query); ?>">
        <input type="submit" name="outputText" value="Output to XML">
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
    </script>    
    </body>
</html>