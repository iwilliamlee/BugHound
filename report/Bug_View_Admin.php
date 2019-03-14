<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound View Bugs</title>
    </head>
    <body>
        <?php
			$con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "Bughound");
            $query = 
                "SELECT bug_id, 
                problem_summary
                program_id,
                report_type,
                severity, 
                area_id,
                assignee
                bug_status,
                priority,
                resolution,
                employee_id,
                bug_date,
                resolve_date
                FROM bugs";
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
            while($row=mysqli_fetch_row($result)) {
                $none=1;
                printf(
                    "<tr>
                        <td>
                            <A href='Bug_Edit_Admin.php?bug_id={$row[0]}'>
                            <span class=\"linkline\">%d</span></a>
                        </td>
                        <td>
                            %s
                        </td>
                        <td>
                            %s
                        </td>
                        <td>
                            %s
                        </td>
                        <td>
                            %s
                        </td>
                        <td>
                            %s
                        </td>
                        <td>
                            %s
                        </td>
                        <td>
                            %s
                        </td>
                        <td>
                            %s
                        </td>
                        <td>
                            %s
                        </td>
                        <td>
                            %s
                        </td>
                        <td>
                            %s
                        </td>
                    </tr>\n",
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