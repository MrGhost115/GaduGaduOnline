<?php
	session_start();
	if(isset($_GET['message']) && $_SESSION['logged']==1){
		require_once 'db_connect.php';
		$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
		
		if ($conn->connect_error) {
			die("0");
		}
		
		$message=htmlentities($_GET['message']);
		
		$sql = 'INSERT INTO messages (ID_Sender, ID_Conversation, Text) 
		VALUES ('.$_SESSION['ID_USER'].', '.$_SESSION['ID_CONV'].', '.$message.') ';
		$result = $conn->query($sql);
		$conn->close();
		
		if($result==1) echo 1; else echo 0;  //Recive 1 when everything is ok, 0 when something went wrong
	}else echo 0;
?>