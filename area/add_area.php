<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add an Area</title>
    </head>
    <body>
		<?php
            $con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "Bughound");
			include '../auth/validate_user.php';		
			isLoggedIn();
		?>
		
        <h1>Add an Area</h1>
        <form action="../Database/add.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Name:</td><td><input type="Text" name="area_name"</td></tr>
                <tr>
                    <td>Program: </td>
                    <td><select name="program_id">
                        <?php
                            $query = "SELECT * FROM programs";
                            $result = mysqli_query($con, $query);
                            $none = 0;
                            while($row=$result->fetch_assoc()) {
                                echo "<option value=".$row['program_id'].">" . $row['program_name'] . " v" . $row['program_version'] . " r" . $row['release_build'] ."</option>";
                            }
                        ?>
                    </select></td>
                </tr>

                <tr><td><input type="submit" name="submit" value="Submit"></td></tr>
                <tr><td><input type="button" value="Cancel" onclick="window.location.href = 'area.php'"></td></tr>
            </table>


        </form>

        <script language=Javascript>

            function validate(theform) {
                if(theform.area_name.value === ""){
                    alert ("Name field must contain characters");
                    return false;
                }
                if(theform.program_id.value == "") {
                    alert ("Must assign to a program");
                    return false;
                }
            }
        </script>

    </body>

</html>