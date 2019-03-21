<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Area</title>
    </head>
    <body>
        <?php
            include '../auth/validate_user.php';	
            isLoggedIn();
			$id = $_GET['area_id'];
            $area_name;
            $programID;
			$con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "Bughound");
			$query = "SELECT area_name, program_id
                FROM areas WHERE area_id = '$id' ";
            $none = 0;
			$result = mysqli_query($con, $query);
            while($row=mysqli_fetch_row($result)) {
                $none=1;
                $area_name = $row[0];
                $programID = $row[1];
            }
		?>
        <p><form action="../Database/update.php" method="post" onsubmit="return validate(this)">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <table>
                <tr><td>Name:</td><td><input type="Text" name="area_name" value="<?php echo htmlspecialchars($area_name); ?>"</td></tr>
                <tr>
                    <td>Program: </td>
                    <td><select name="program_id">
                        <?php
                            $query = "SELECT * FROM programs";
                            $result = mysqli_query($con, $query);
                            $none = 0;
                            while($row=$result->fetch_assoc()) {
                                if($row['program_id'] === $programID){
                                    echo "<option value=".$row['program_id']." selected='selected'>" . $row['program_name'] . " v" . $row['program_version'] . "</option>";
                                } else {
                                    echo "<option value=".$row['program_id'].">" . $row['program_name'] . " v" . $row['program_version'] . "</option>";
                                }
                            }
                        ?>
                    </select></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Submit">
        </form>
        <p><form action="../Database/delete.php" method="post">
            <input type="hidden" name="area_id" value="<?php echo htmlspecialchars($id); ?>">
            <input type="submit" name="delete" value="Delete">
        </form>
        <script language=Javascript>

            function validate(theform) {
                if(theform.name.value === ""){
                    alert ("Name field must contain characters");
                    return false;
                }
            }
        </script>

        <INPUT type="button" value="Cancel" id=button1 name=button1 onclick="go_home()">
        <form action="./Export_Single_Area.php" method="post">
            <input type="hidden" name="areaID" value="<?php echo htmlspecialchars($id); ?>">
            <input type="submit" name="outputText" value="Output to XML">
        </form>
        <script language=Javascript>
            function go_home() {
                window.location.replace("area.php");
            }
        </script>    
    </body>
</html>

