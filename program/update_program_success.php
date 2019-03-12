<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Update Successful</title>
    </head>
    <body>
        <h2>
            <?php
				$id = $_POST['id'];
                $name = $_POST['program_name'];
                $release = $_POST['release'];
                $version = $_POST['version'];

                $con = mysqli_connect("localhost","root");
                mysqli_select_db($con, "Bughound");
                $query = "UPDATE programs SET 
                    program_name = '$name', 
                    release_build = '$release', 
                    version = '$version' 
                    WHERE program_id = '$id' ";

				mysqli_query($con, $query);
            ?>
            You have successfully updated program: <?php printf("<p> %s.<p>",$name); ?>
            <p>
            <input type="button" value="Return" id=button1 name=button1 onclick="go_home()">    
        </h2>
        <script language=Javascript>
            function go_home(){
                window.location.replace("program.php");
            }
        </script>
    </body>
</html>