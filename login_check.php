		<?php
		    $username = $_POST['username'];
			$password = $_POST['password'];
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "Bughound");
			$query = "SELECT * FROM `employees` WHERE user_name='".$username."' AND password='".$password."';";
			$result = mysqli_query($con, $query);
			if (mysqli_num_rows($result) == 0)
			{ 
				echo "<SCRIPT type='text/javascript'>
					alert('Invalid Username/Password');
					window.location.replace('login.php');
					</SCRIPT>";
			}
			else
			{
				$row = mysqli_fetch_array($result);
				$user_level = $row['user_level'];
				//$cookie_name = "user_level";
				//setcookie(cookie_name, user_level,time()+3600 , '/');
				
				session_start();
				$_SESSION["user_level"] = $user_level;
				$_SESSION["username"] = $username;
				$_SESSION["login"] = true;
				
				header("Location: index.php");
				die();
			}
		?>