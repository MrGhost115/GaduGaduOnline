<?php
	session_start();
	
	if(isset($_POST['nickname']) && isset($_POST['password'])){
		$_SESSION['sess'] = true;
		$nickname = htmlentities($_POST['nickname']);
		$password = htmlentities($_POST['password']);
		
		require_once 'db_connect.php';
		$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = 'SELECT Nick FROM users WHERE users.Nick='.$nickname;
		$result = $conn->query($sql);
		$amount = @$result->num_rows;
		
		if(!($amount>0 && $row = $result->fetch_assoc())){
			
			$password = password_hash(addslashes($password), PASSWORD_DEFAULT);
			
			$sql = 'INSERT INTO users (Nick, Password) VALUES ("'.$nickname.'", "'.$password.'")';
			$result = $conn->query($sql);
			
			$conn->close();
			session_unset();
			header("Location:index.php");
		}else $_SESSION['error']='This nickname is not available';
	}
?>
<form method="post" >
Nickname: <input type="text" name="nickname"<?php echo(isset($_SESSION['sess']))?'value="'.$nickname.'"':'';?> required /><br />
Password: <input type="password" name="password" <?php echo(isset($_SESSION['sess']))?'value="'.$password.'"':'';?> required /><br />
<input type="submit" value="Register" />
</form>
<?php
	unset($_SESSION['sess']); 
?>