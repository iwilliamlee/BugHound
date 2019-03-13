<!DOCTYPE html>
<html>
<?php
	include 'auth/validate_user.php';		
	isLoggedIn();
	
	$type = $_POST['type'];

    $html = <<<EOT
	
	<head>
		<meta charset="UTF-8">
		<title>$type</title>
	</head>
	<body>
	<h1>Search $type</h1>
	<form action="edit.php" method="post" id ="$type" onsubmit="return validate(this)">
		<table>
			<tr>
				<td>$type ID:</td>
				<td><input type="Text" name="$type._id" </td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Search"></form>
		<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
		
		<script language=Javascript>
			function validate(theform) {
				if(theform.$type.value === ""){
					alert ("$type cannot be null");
					return false;
				}
				return true;
			}
			function cancel(){
				window.location.replace("$type.php");
			}
		</script>  
	</body>
EOT;
	echo $html;
	
?>
</html>		

