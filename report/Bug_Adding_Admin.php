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
                $reproducible = isset($_POST['reproducible']);
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
                $deferred = isset($_POST['deferred']);
                
				$con = mysqli_connect("localhost","root");
                mysqli_select_db($con, "Bughound");
				$query = "INSERT INTO bugs (
                    program_id, report_type, severity, 
                    problem_summary, reproducible,
                    problem, 
                    suggested_fix,
                    employee_id, bug_date, 

                    area_id,assignee,
                    comments,
                    bug_status, priority, resolution, resolution_version, 
                    resolvee, resolve_date, testee, test_date, deferred)
                    VALUES (
                        '$programID', '$reportType', '$severity', 
                        '$problemSummary', '$reproducible',
                        '$problem',
                        '$suggestedFix',
                        '$reportedBy', '$dateEntered',

                        '$functionalArea', '$assignedTo',
                        '$comments',
                        '$status','$priority','$resolution','$resolutionVersion',
                        '$resolvedBy','$dateResolved','$testedBy','$dateTested', '$deferred')";
                if(!mysqli_query($con, $query))
                {
                    echo("error is: " .mysqli_error($con));
                };
                $bugID = mysqli_insert_id($con);
                printf("<p>Bug added. Reference number: %d</p>", $bugID);

                //uploading file
                if(isset($_POST['submit'])){
                    // Count total files
                    $countfiles = count($_FILES['file']['name']);
                    // Looping all files
                    for($i=0;$i<$countfiles;$i++){
                        $filename = $_FILES['file']['name'][$i];
                        
                        // Upload file
                        move_uploaded_file($_FILES['file']['tmp_name'][$i],'uploads/'.$filename);
                        $query = "INSERT INTO attachments (file_name, bug_id)
                            VALUES ('$filename', '$bugID')";
                        if(!mysqli_query($con, $query))
                        {
                            echo("error is: " .mysqli_error($con));
                        };
                    }
                } 
            ?>
            <input type="button" value="Return" id=button1 name=button1 onclick="go_home()">    
        </h2>
        <script language=Javascript>
            function go_home(){
                window.location.replace("../index.php");
            }
        </script>
            
    </body>
</html>
