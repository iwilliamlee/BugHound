<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Adding Bug</title>
    </head>
    <body>
        <h2>
            <?php
                $con = mysqli_connect("localhost","root");
                mysqli_select_db($con, "Bughound");
                $programID = $_POST['programName'];
                $reportType = $_POST['reportType'];
				$severity = $_POST['severity'];
                $problemSummary = mysqli_real_escape_string($con, $_POST['problemSummary']);
                $reproducible = isset($_POST['reproducible']);
                $problem = mysqli_real_escape_string($con, $_POST['problem']);
                $suggestedFix = mysqli_real_escape_string($con, $_POST['suggestedFix']);
                $reportedBy = $_POST['reportedBy'];
                $dateEntered = $_POST['dateEntered'];
                $functionalArea = $_POST['functionalArea']; //Default to area '1'
                
				$query = "INSERT INTO bugs (
                    program_id, report_type, severity, 
                    problem_summary, reproducible,
                    problem, 
                    suggested_fix,
                    employee_id, bug_date,
                    
                    area_id)
                    VALUES (
                        '$programID', '$reportType', '$severity', 
                        '$problemSummary', '$reproducible',
                        '$problem',
                        '$suggestedFix',
                        '$reportedBy', '$dateEntered',
                        
                        '$functionalArea')";
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
                window.location.replace("./bug_view.php");
            }
        </script>
            
    </body>
</html>
