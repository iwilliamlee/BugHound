<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Bug Updated</title>
    </head>
    <body>
        <h2>
            <?php
            $con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "Bughound");
                $bugID = $_POST['bugID'];
                $programID = $_POST['programName'];
                $reportType = $_POST['reportType'];
				$severity = $_POST['severity'];
                $problemSummary = mysqli_real_escape_string($con, $_POST['problemSummary']);
                $reproducible = isset($_POST['reproducible']);
                $problem = mysqli_real_escape_string($con, $_POST['problem']);
                $suggestedFix = mysqli_real_escape_string($con, $_POST['suggestedFix']);
                $reportedBy = $_POST['reportedBy'];
                $dateEntered = $_POST['dateEntered'];
                $functionalArea = $_POST['functionalArea'];
                $assignedTo = $_POST['assignedTo'];
                $comments = mysqli_real_escape_string($con, $_POST['comments']);
                $status = $_POST['status'];
                $priority = $_POST['priority'];
                $resolution = $_POST['resolution'];
                $resolutionVersion = $_POST['resolutionVersion'];
                $resolvedBy = $_POST['resolvedBy'];
                $dateResolved = $_POST['dateResolved'];
                $testedBy = $_POST['testedBy'];
                $dateTested = $_POST['dateTested'];
                $deferred = isset($_POST['deferred']);
                
                printf("<p>Bug %d updated</p>", $bugID);
				$query = "UPDATE bugs SET
                    program_id = '$programID', report_type = '$reportType', severity = '$severity', 
                    problem_summary = '$problemSummary', reproducible = '$reproducible',
                    problem = '$problem', 
                    suggested_fix = '$suggestedFix',
                    employee_id = '$reportedBy', bug_date = '$dateEntered', 

                    area_id = '$functionalArea', assignee = '$assignedTo',
                    comments = '$comments',
                    bug_status = '$status', priority = '$priority', resolution = '$resolution', resolution_version = '$resolutionVersion', 
                    resolvee = '$resolvedBy', resolve_date = '$dateResolved', testee = '$testedBy', test_date = '$dateTested', deferred = '$deferred'
                    WHERE bug_id = '$bugID' ";
                if(!mysqli_query($con, $query))
                {
                    echo("error is: " .mysqli_error($con));
                };
                printf("<p>Bug %d updated</p>", $bugID);

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
                window.location.replace("./bug_view.php");
            }
        </script>
            
    </body>
</html>
