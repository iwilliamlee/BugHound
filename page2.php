<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<title>CECS 544 Lab 1 Page 2</title>
</head>
<body>
<h2>
<?php
    $name = $_POST['name'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $user_level = $_POST['user_level'];
    
    printf("You entered %s %s %s %s as your name.<p>",$name,$user_name, $password, $user_level);
    $con = mysqli_connect("localhost","root");

    mysqli_select_db($con, "Bughound");
    
    $query = "INSERT INTO employees (
        name, 
        user_name,
        password,
        user_level
    ) VALUES ('".$name."','".$user_name."','".$password."','".$user_level."')";
    
    echo $query;
    
    mysqli_query($con, $query);
    header("Location:page3.php");
    exit;

    
    ?>
You have successfully completed Lab1!
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
