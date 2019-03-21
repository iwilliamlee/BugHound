<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound New Bug</title>
    </head>
    <body>
    <?php
        $con = mysqli_connect("localhost","root");
        mysqli_select_db($con, "Bughound");
    ?>
        <h1>New Bug Report Entry Page</h1>
        <form action="Bug_Adding_Admin.php" method="post" enctype="multipart/form-data" onsubmit="return validate(this)">
            <table>
                <tr><!-- Line 1 -->
                    <td>Program:</td> 
                    <td><select name="programName">
                        <?php
                            $query = "SELECT * FROM programs";
                            $result = mysqli_query($con, $query);
                            $none = 0;
                            while($row=$result->fetch_assoc()) {
                                unset($id, $name);
                                $id = $row['program_id'];
                                $name = $row['program_name'];
                                echo "<option value=".$id.">" . $name . " Ver. " . $row['program_version'] . " Re. " . $row['release_build'] .
                                "</option>";
                            }
                        ?>
					</select></td>
                    <td>Report Type:</td>
                    <td><select name="reportType">
					  <option value="codingError">Coding Error</option>
					  <option value="design_Issue">Design Issue</option>
					  <option value="suggestion">Suggestion</option>
					  <option value="documentation">Documentation</option>
                      <option value="hardware">Hardware</option>
                      <option value="query">Query</option>
					</select></td>
                    <td>Severity:</td>
                    <td><select name="severity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
					</select></td>
                </tr>
            </table>
            <table><!-- Line 2 -->
                <tr>
                    <td>Problem Summary:</td>
                    <td><input type="Text" name="problemSummary" size="45"></td>
                    <td><input type="checkbox" name="reproducible" value="yes">Reproducible?<br></td>
                </tr>
                <tr><!-- Line 3 -->
                    <td>Problem:</td>
                    <td><input type="Text" name="problem" size="45"></td>
                </tr>
                <tr><!-- Line 4 -->
                    <td>Suggested Fix:</td>
                    <td><input type="Text" name="suggestedFix" size="45"></td>
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
                                echo "<option value=".$row['employee_id'].">".$row['user_name']."</option>";
                            }
                        ?>
					</select></td>
                    <td>Date(yyyy/mm/dd): </td>
                    <td><input type="Text" name="dateEntered" size="5"></td>
				</tr>
            </table>
            Select image to upload:
            <input type="file" name="file[]" id="file" multiple="">
            <hr> <!--New Section-->
            <table><!--line 1-->
                <tr>
                    <td>Functional Area:</td>
                    <td><select name="functionalArea">
                    <?php
                        $query = "SELECT * FROM areas";
                        $result = mysqli_query($con, $query);
                        $none = 0;
                        while($row=$result->fetch_assoc()) {
                            echo "<option value=".$row['area_id'].">" . $row['area_name'] . "</option>";
                        }
                    ?>
					</select></td>
                    <td>Assigned To: </td>
                    <td><select name="assignedTo">
                        <?php
                            $query = "SELECT * FROM employees";
                            $result = mysqli_query($con, $query);
                            $none = 0;
                            while($row=$result->fetch_assoc()) {
                                echo "<option value=".$row['employee_id'].">" . $row['user_name'] . "</option>";
                            }
                        ?>
					</select></td>
				</tr>
            </table>
            <table>
                <tr>
                    <td>Comments</td>
                    <td><input type="Text" name="comments" size="45"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Status</td>
                    <td><select name="status">
					  <option value="open">Open</option>
					  <option value="close">Close</option>
					</select></td>
                    <td>Priority</td>
                    <td><select name="priority">
                    <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
					</select></td>
                    <td>Resolution</td>
                    <td><select name="resolution">
                      <option value="0">On Going</option>
                      <option value="1">Resolved</option>
					  <option value="2">Escalated</option>
					</select></td>
                    <td>Resolution Version</td>
                    <td><select name="resolutionVersion">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
					</select></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Resolved By</td>
                    <td><select name="resolvedBy">
                        <?php
                            $query = "SELECT * FROM employees";
                            $result = mysqli_query($con, $query);
                            $none = 0;
                            while($row=$result->fetch_assoc()) {
                                echo "<option value=".$row['employee_id'].">" . $row['user_name'] . "</option>";
                            }
                        ?>
					</select></td>
                    <td>Date(yyyy/mm/dd): </td>
                    <td><input type="Text" name="dateResolved" size="5"></td>
                    <td>Tested by:</td>
                    <td><select name="testedBy">
                        <?php
                            $query = "SELECT * FROM employees";
                            $result = mysqli_query($con, $query);
                            $none = 0;
                            while($row=$result->fetch_assoc()) {
                                echo "<option value=".$row['employee_id'].">" . $row['user_name'] . "</option>";
                            }
                        ?>
					</select></td>
                    </select></td>
                    <td>Date(yyyy/mm/dd): </td>
                    <td><input type="Text" name="dateTested" size="5"></td>
                    <td><input type="checkbox" name="deferred" value="yes">Treated as deferred?<br></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Next">
            <input type="button" name="reset" value="Reset" onclick="reset()">
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
                window.location.replace("../index.php");
            }
            function reset() {
                window.location.reload(true);
            }
        </script>  
    </body>
</html>
