<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Update Successful</title>
    </head>
    <body>
        <h2>
            <?php
                include '../auth/validate_user.php';	
                isLoggedIn();
				$id = $_POST['ID'];
                $name = $_POST['name'];
                $username = $_POST['username'];
				$password = $_POST['password'];
				$userlevel = $_POST['userlevel'];
				$con = mysqli_connect("localhost","root");
                mysqli_select_db($con, "Bughound");
				$query = "UPDATE employees SET 
                    name = '$name', 
                    user_name = '$username', 
                    password = '$password', 
                    user_level = '$userlevel' 
                    WHERE employee_id = '$id' ";
                mysqli_query($con, $query);
                
                //Update the cookies
                $_SESSION["user_level"] = $userlevel;
                $_SESSION["username"] = $username;
            ?>
            You have successfully updated employee: <?php printf("<p> %s.<p>",$name); ?>
            <p>
            <input type="button" value="Return" id=button1 name=button1 onclick="go_home()">    
        </h2>
        <script language=Javascript>
            function go_home(){
                window.location.replace("View_Employee.php");
            }
        </script>
    </body>
</html>