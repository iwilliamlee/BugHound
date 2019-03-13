<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Adding Bug</title>
    </head>
    <body>
        <h2>
            <?php
                $programID = $_POST['programName'];
                $reportType = $_POST['reportType'];
				$severity = $_POST['severity'];
                $problemSummary = $_POST['problemSummary'];
                $problem = $_POST['problem'];
                $suggestedFix = $_POST['suggestedFix'];
                $reportedBy = $_POST['reportedBy'];
                $dateEntered = $_POST['dateEntered'];
                $functionalArea = $_POST['functionalArea']; //should be area id
                $assignedTo = $_POST['assignedTo'];
                $comments = $_POST['comments'];
                $status = $_POST['status'];
                $priority = $_POST['priority'];
                $resolution = $_POST['resolution'];
                $resolutionVersion = $_POST['resolutionVersion'];
                $resolvedBy = $_POST['resolvedBy'];
                $dateResolved = $_POST['dateResolved'];
                $testedBy = $_POST['testedBy'];
                $dateTested = $_POST['dateTested'];
                
				$con = mysqli_connect("localhost","root");
                mysqli_select_db($con, "Bughound");
				$query = "INSERT INTO bugs (
                    program_id, report_type, severity, 
                    problem_summary, 
                    problem, 
                    suggested_fix,
                    employee_id, bug_date, 

                    area_id,assignee,
                    comments,
                    bug_status, priority, resolution, resolution_version, 
                    resolvee, resolve_date, testee, test_date)
                    VALUES (
                        '$programID', '$reportType', '$severity', 
                        '$problemSummary',
                        '$problem',
                        '$suggestedFix',
                        '$reportedBy', '$dateEntered',

                        '$functionalArea', '$assignedTo',
                        '$comments',
                        '$status','$priority','$resolution','$resolutionVersion',
                        '$resolvedBy','$dateResolved','$testedBy','$dateTested')";
                if(!mysqli_query($con, $query))
                {
                    echo("error is: " .mysqli_error($con));
                };
                printf("<p>Bug added.<p>");
                printf($programID);
            ?>
            You have successfully added an Employee!
            <input type="button" value="Return" id=button1 name=button1 onclick="go_home()">    
        </h2>
        <script language=Javascript>
            function go_home(){
                window.location.replace("../index.php");
            }
        </script>
            
    </body>
</html>
