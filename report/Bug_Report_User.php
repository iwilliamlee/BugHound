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
        <form action="Bug_Adding_User.php" method="post" enctype="multipart/form-data" onsubmit="return validate(this)">
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
                                echo "<option value=".$id.">" . $name . " Ver" . $row['program_version'] . " Re" . $row['release_build'] . "</option>";
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
                        <option value="1">fatal</option>
                        <option value="2">minor</option>
                        <option value="3">serious</option>
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
            <input type="hidden" name="functionalArea" value='3'> <!-- TODO://default AREA for all new bugs -->

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