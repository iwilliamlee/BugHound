<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Program</title>
    </head>
    <body>
        <?php
			$id = $_GET['program_id'];
			$program_name;
			$version;
			$release;
			$con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "Bughound");
			$query = "SELECT program_name,
                version,
                release_build
                FROM programs WHERE program_id = '$id' ";
            $none = 0;
			$result = mysqli_query($con, $query);
            while($row=mysqli_fetch_row($result)) {
                $none=1;
				$program_name = $row[0];
				$version = $row[1];
				$release = $row[2];
            }
		?>
        <form action="../update.php" method="post" onsubmit="return validate(this)">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <table>
                <tr><td>Name:</td><td><input type="Text" name="program_name" value="<?php echo htmlspecialchars($program_name); ?>"</td></tr>
            </table>
            <table>
                <tr><td>Release:</td><td><input type="Number" name="release" value="<?php echo htmlspecialchars($release); ?>"</td></tr>
            </table>
            <table>
                <tr><td>Version:</td><td><input type="Number" name="version" value="<?php echo htmlspecialchars($version); ?>"</td></tr>
            </table>
            <input type="submit" name="submit" value="Submit">
        </form>

        <script language=Javascript>

            function validate(theform) {
                if(theform.name.value === ""){
                    alert ("Name field must contain characters");
                    return false;
                }
                if(theform.release.value === ""){
                    alert ("Release field must contain a number");
                    return false;
                }
                if(theform.version.value === ""){
                    alert ("Version field must contain a number");
                    return false;
                }
            }
        </script>

        <p><INPUT type="button" value="Cancel" id=button1 name=button1 onclick="go_home()">
        <script language=Javascript>
            function go_home() {
                window.location.replace("program.php");
            }

</script>    
    </body>
</html>

