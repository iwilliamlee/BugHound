<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>CECS 544 Lab 4 Page 2</title>
    </head>
    <body>
        <h2>
            <?php
                $name = $_POST['name'];
                $username = $_POST['username'];
				$password = $_POST['password'];
				$userlevel = $_POST['userlevel'];
                /* printf("You entered %s %s as your name.<p>",$first,$last);? */
				$con = mysqli_connect("localhost","root");
                mysqli_select_db($con, "Bughound");
				$query = "INSERT INTO employees (name, user_name, password, user_level) VALUES ('".$name."','".$username."','".$password."','".$userlevel."')";
				/* echo $query; */
				mysqli_query($con, $query);

            ?>
            You have successfully added an Employee!
            <p>
            <input type="button" value="Return" id=button1 name=button1 onclick="go_home()">    
        </h2>
        <script language=Javascript>
            function go_home(){
                window.location.replace("index.php");
            }
        </script>
            
    </body>
</html>
