<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Edit Bug</title>
    </head>
    <body>
    <?php
        $con = mysqli_connect("localhost","root");
        mysqli_select_db($con, "Bughound");

        $bug_id = $_GET['bug_id']; 

        $query = "SELECT 
                program_id, report_type, severity, 
                problem_summary, reproducible,
                problem, 
                suggested_fix,
                employee_id, bug_date, 

                area_id,assignee,
                comments,
                bug_status, priority, resolution, resolution_version, 
                resolvee, resolve_date, testee, test_date, deferred
            FROM bugs WHERE bug_id = '$bug_id' ";
        $none = 0;
        $result = mysqli_query($con, $query);
        while($row=mysqli_fetch_row($result)) {
            $programID = $row[0]; $reportType = $row[1]; $severity = $row[2];
            $problemSummary = $row[3]; $reproducible = $row[4];
            $problem = $row[5];
            $suggestedFix = $row[6];
            $reportedBy = $row[7];  $dateEntered = $row[8];

            $functionalArea = $row[9]; $assignedTo = $row[10];
            $comments = $row[11];
            $status = $row[12]; $priority = $row[13]; $resolution = $row[14]; $resolutionVersion = $row[15];
            $resolvedBy = $row[16]; $dateResolved = $row[17]; $testedBy = $row[18]; $dateTested = $row[19]; $deferred = $row[20];
        }
    ?>
        <h1>Edit Bug Report Entry Page</h1>
        <form action="Bug_Update_User.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                        <?php echo "<td> Bug ID: <input type='text' name='bugID' readonly size='1' value=' " .$bug_id. "'";?> </td>
                </tr>
                <tr><!-- Line 1 -->
                    <td>Program:</td> 
                    <td><select name="programName">
                        <?php
                            $query = "SELECT * FROM programs";
                            $result = mysqli_query($con, $query);
                            $none = 0;
                            while($row=$result->fetch_assoc()) {
                                if($row['program_id'] == $programID){
                                    echo "<option value=".$row['program_id']." selected='selected'>" . $row['program_name'] . " Ver. " . $row['program_version'] . " Re. " . $row['release_build'] ."</option>";
                                } else {
                                    echo "<option value=".$row['program_id'].">" . $row['program_name'] . " Ver. " . $row['program_version'] . " Re. " . $row['release_build'] ."</option>";
                                }
                            }
                        ?>
					</select></td>
                    <td>Report Type:</td>
                    <td><select name="reportType">
					  <option value="codingError" 
                        <?php if($reportType == "codingError") { ?> selected="selected" <?php } ?>>Coding Error</option>
					  <option value="design_Issue"
                        <?php if($reportType == "design_Issue") { ?> selected="selected" <?php } ?>>Design Issue</option>
					  <option value="suggestion"
                        <?php if($reportType == "suggestion") { ?> selected="selected" <?php } ?>>Suggestion</option>
					  <option value="documentation"
                        <?php if($reportType == "documentation") { ?> selected="selected" <?php } ?>>Documentation</option>
                      <option value="hardware"
                        <?php if($reportType == "hardware") { ?> selected="selected" <?php } ?>>Hardware</option>
                      <option value="query"
                        <?php if($reportType == "query") { ?> selected="selected" <?php } ?>>Query</option>
					</select></td>
                    <td>Severity:</td>
                    <td><select name="severity">
					  <option value="1" 
                        <?php if($severity == 1) { ?> selected="selected" <?php } ?> >fatal</option>
					  <option value="2"
                        <?php if($severity == 2) { ?> selected="selected" <?php } ?> >minor</option>
					  <option value="3"
                        <?php if($severity == 3) { ?> selected="selected" <?php } ?> >serious</option>
					</select></td>
                </tr>
            </table>
            <table><!-- Line 2 -->
                <tr>
                    <td>Problem Summary:</td>
                    <td><input type="Text" name="problemSummary" size="45" value="<?php echo $problemSummary; ?>"></td>
                    <td><input type="checkbox" name="reproducible" value="yes"
                        <?php if($reproducible) { ?> checked <?php } ?> >Reproducible?<br></td>
                </tr>
                <tr><!-- Line 3 -->
                    <td>Problem:</td>
                    <td><input type="Text" name="problem" size="45" value="<?php echo $problem; ?>"></td>
                </tr>
                <tr><!-- Line 4 -->
                    <td>Suggested Fix:</td>
                    <td><input type="Text" name="suggestedFix" size="45" value="<?php echo $suggestedFix; ?>"></td>
				</tr>
            </table>
            <table><!-- Line 5 -->
				<tr>
                    <td>Reported By:</td>
                    <td><select name="reportedBy">
                        <?php
                            $query = "SELECT * FROM employees";
                            $result = mysqli_query($con, $query);
                            $none = 0;
                            while($row=$result->fetch_assoc()) {
                                if($row['employee_id'] == $reportedBy){
                                    echo "<option value=".$row['employee_id']." selected='selected'>" . $row['user_name'] . "</option>";
                                } else {
                                    echo "<option value=".$row['employee_id'].">" . $row['user_name'] . "</option>";
                                }
                            }
                        ?>
					</select></td>
                    <td>Date(yyyy/mm/dd): </td>
                    <td><input type="Text" name="dateEntered" size="6" value="<?php echo $dateEntered; ?>"></td>
				</tr>
            </table>
            <table>
                <tr>
                    <td>Attachments:</td>
                    <?php
                        $query = "SELECT bugs.bug_id, attachments.file_name 
                            FROM bugs
                            INNER JOIN attachments ON bugs.bug_id = attachments.bug_id
                            WHERE bugs.bug_id = '".$bug_id."'
                            ";
                        $result = mysqli_query($con, $query);
                        echo "<tr>Name</tr>\n";
                        $none = 0;
                        while($row=mysqli_fetch_row($result)) {
                            $none=1;
                            
                            printf(
                                "<tr><td>
                                    <a href='./uploads/%s' download=%s>%s</a>
                                </td></tr>\n",$row[1], $row[1], $row[1]);
                        }
                    ?>
                </tr>
            </table>
            Select image to upload:
            <input type="file" name="file[]" id="file" multiple="">
            <hr> <!--Hidden area for posting-->
            <?php echo "<input type='hidden' name='functionalArea' readonly size='1' value=' " .$functionalArea. "'";?>


            <input type="submit" name="submit" value="Next"> <!-- I don't know why but this first button won't show up -->
            <input type="submit" name="submit" value="Next">
            <input type="button" name="cancel" value="Cancel" onclick="go_home()">
        </form>
        <script language=Javascript>
            function validate(theform) {
                if(theform.problemSummary.value === ""){
                    alert ("Problem Summary field must contain characters");
                    return false;
                }
                if(theform.problem.value === ""){
                    alert ("Problem field must contain characters");
                    return false;
                }
				if(theform.dateEntered.value === ""){
                    alert ("Date Entered field must contain characters");
                    return false;
                }
                return true;
            }
		</script>
        <script language=Javascript>
            function go_home() {
                window.location.replace("./bug_view.php");
            }
        </script>  
    </body>
</html>
