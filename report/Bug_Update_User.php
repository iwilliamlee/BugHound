<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Bug Updated</title>
    </head>
    <body>
        <h2>
            <?php
                $bugID = $_POST['bugID'];
                $programID = $_POST['programName'];
                $reportType = $_POST['reportType'];
				$severity = $_POST['severity'];
                $problemSummary = $_POST['problemSummary'];
                $reproducible = isset($_POST['reproducible']);
                $problem = $_POST['problem'];
                $suggestedFix = $_POST['suggestedFix'];
                $reportedBy = $_POST['reportedBy'];
                $dateEntered = $_POST['dateEntered'];
                $functionalArea = $_POST['functionalArea'];

                printf("<p>Bug %d updated</p>", $bugID);
				$con = mysqli_connect("localhost","root");
                mysqli_select_db($con, "Bughound");
				$query = "UPDATE bugs SET
                    program_id = '$programID', report_type = '$reportType', severity = '$severity', 
                    problem_summary = '$problemSummary', reproducible = '$reproducible',
                    problem = '$problem', 
                    suggested_fix = '$suggestedFix',
                    employee_id = '$reportedBy', bug_date = '$dateEntered', 

                    area_id = '$functionalArea'
                    WHERE bug_id = '$bugID' ";
                if(!mysqli_query($con, $query))
                {
                    echo("error is: " .mysqli_error($con));
                };
                // $bugID = mysqli_insert_id($con);
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
                window.location.replace("../index.php");
            }
        </script>
            
    </body>
</html>
