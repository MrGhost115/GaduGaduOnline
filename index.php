<?php
	session_start();
	$_SESSION['logged'] = 0;
	if(isset($_POST['nick'])){
		require_once 'db_connect.php';
		$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$name = htmlentities($_POST['nick']);
		$pass = htmlentities($_POST['pass']);
		$sql = 'SELECT Password FROM users where Nick="'.$name.'"';
		$result = $conn->query($sql);
		if(($result->num_rows)>0){
			$row = $result->fetch_assoc();	
			$password2 = $row['Password'];
			
			
			if(password_verify($pass, $password2)){
				$_SESSION['logged'] = 1;
				$_SESSION['nick'] = $name;
				
				$sql = 'SELECT ID FROM users where Nick="'.$name.'"';
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				$_SESSION['ID_USER'] = $row['ID'];
				
				$sql = 'UPDATE users SET OnlineStatus = 1 WHERE users.ID = '.$_SESSION['ID_USER'];
				$conn->query($sql);
				$conn->close();
				
				header('Location: chat.php');
			}else{
				echo '<h2>Invalid Username/Password</h2>';
			}
		}else{
			echo '<h2>Invalid Username/Password</h2>';
		}
		$conn->close();
	}
?>
<form method="post">
	Nickname: <input type="text" name="nick" /> 
	Password: <input type="text" name="pass" /> 
	<input type="submit" />
</form>