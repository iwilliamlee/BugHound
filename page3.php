<!DOCTYPE html>


<html>

<head>

<meta charset="UTF-8">

<title>View-Select Edit Employees</title>

</head>

<body>

<?php

//MISSING connect to the database

//MISSING select the database

//MISSING construct query string for all the contents of people

//MISSING execute the query
echo "<h1>View-Select edit for Employees</h1>";
echo "<table border=1 ><th>ID</th><th>First</th>\n";

$none = 0;

$con = mysqli_connect("localhost","root");
mysqli_select_db($con, "Bughound");
$sql = "SELECT * FROM employees";
$result = $con->query($sql);

while($row=mysqli_fetch_row($result)) {

$none=1;

$employee_url = "employee_update.php/?eid=";
$employee_number = '';

printf("
    <tr>
        <td><a href='$employee_url'>%d</a></td>
        <td>%s</td>
    </tr>\n",$row[0],$row[1]
);

}

?>

</table>

<?php

if($none==0)

Echo "<h3>No matching records found.</h3>\n";

?>

<p><INPUT type="button" value="Cancel" id=button1 name=button1 onclick="go_home()">

<script language=Javascript>


function go_home() {

window.location.replace("index.php");

}


</script>

</body>

</html>


