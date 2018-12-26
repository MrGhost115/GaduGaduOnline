<?php
	session_start();
	if(isset($_GET['message']) && $_SESSION['logged']==1){
		require_once 'db_connect.php';
		$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
		
		if ($conn->connect_error) {
			die("0");
		}
		
		$sql = 'SELECT messages.Text, messages.TimeSend, users.Nick FROM messages 
		INNER JOIN users ON messages.ID_Sender=users.ID
		WHERE messages.ID_Conversation='.$_SESSION['ID_CONV'].'
		AND messages.ID>'.$_SESSION['lastMsgID'].'AND messages.ID_Sender!="'.$_SESSION['ID_USER'].'"';
		$result = $conn->query($sql);
		$amount = @$result->num_rows;
		$conn->close();
		
		if($result==1 && $amount>0){
			while($row = $result->fetch_assoc()){
				echo $row['TimeSend'].' '.$row['Nick'].' '.$row['Text'].'<br />'; //Time, Nick, Message, I used space to separate values
			}
		}else die("0");
	}else die("0");
?>