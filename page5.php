<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>CECS 544 Lab 4 Page 5</title>
    </head>
    <body>
        <h2>
            <?php
				$id = $_POST['ID'];
                $name = $_POST['name'];
                $username = $_POST['username'];
				$password = $_POST['password'];
				$userlevel = $_POST['userlevel'];
				$con = mysqli_connect("localhost","root");
				mysqli_select_db($con, "employee");
				$query = "UPDATE employee SET empName = '$name', username = '$username', password = '$password', level = '$userlevel' WHERE ID = '$id' ";
				mysqli_query($con, $query);

            ?>
            You have successfully updated an Employee!
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