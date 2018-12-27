<?php
	session_start();
	
	require_once 'db_connect.php';
	$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
	
	$sql = 'UPDATE users SET OnlineStatus = 0 WHERE users.ID = "'.$_SESSION['ID_USER'].'"';
	$conn->query($sql);
	$conn->close();
	
	session_unset();
	header("Location: index.php");
?>