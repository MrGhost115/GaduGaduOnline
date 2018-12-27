<?php
	session_start();
	
	$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
	
	$sql = 'UPDATE users SET StatusOnline = 0 WHERE users.ID = "'.$_SESSION['ID_USER'].'"';
	$result = $conn->query($sql);
	$conn->close();
	
	session_unset();
	header("Location: index.php");
?>