<?php
	session_start();
	$_SESSION['ID_CONV']=0;
	if(isset($_GET['c']) && $_GET['c']!="" && is_numeric($_GET['c'])) $_SESSION['ID_CONV'] = $_GET['c'];
	
	if($_SESSION['logged']==1){
		require_once 'db_connect.php';
		$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		if($_SESSION['ID_CONV']!=0){
			$sql = 'SELECT users.Nick, users.OnlineStatus FROM participants 
					LEFT JOIN users ON participants.ID_User=users.ID
					LEFT JOIN conversations ON participants.ID_Conversation=conversations.ID
					WHERE participants.ID_Conversation='.$_SESSION['ID_CONV'].' 
					AND users.ID!='.$_SESSION['ID_USER'];
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$NickFriend = $row['Nick'];
			$OnlineStatus = $row['OnlineStatus'];
		}
	}else{
		header("Location: index.php");
		die();
	}
?>
<?php //wstawic do wypisania nicku rozmowcy
	if($_SESSION['ID_CONV']!=0)echo $NickFriend;
?>
<?php //wstawic do wypisania statusu rozmowcy
	if($_SESSION['ID_CONV']!=0)echo $OnlineStatus; // 1 -  Online, 0 - Offline
?>
<br /><br /><br />
<?php //wstawic do wypisania kontaktow
	$sql = 'SELECT participants.ID_Conversation FROM users 
			INNER JOIN participants ON participants.ID_User=users.ID
			WHERE participants.ID_User='.$_SESSION['ID_USER'];
	$result = $conn->query($sql);
	$amount = $result->num_rows;
	
	$sql = 'SELECT users.Nick, messages.Text, users.OnlineStatus, participants.ID_Conversation FROM users 
			LEFT JOIN participants ON participants.ID_User=users.ID
			LEFT JOIN messages ON participants.ID_Conversation=messages.ID_Conversation
			WHERE ';
			
	if($result && $amount>0){
		while($row = $result->fetch_assoc()){
			$sql = $sql.'participants.ID_Conversation='.$row['ID_Conversation'].' OR ';
		}
		
		$sql = substr($sql,0,-4).' ORDER BY messages.ID ASC LIMIT 1';
		$result = $conn->query($sql);
		$amount = $result->num_rows;
		
		if($result && $amount>0){
			while($row = $result->fetch_assoc()){
				echo '<a href="chat.php?c='.$row['ID_Conversation'].'">'.$row['Nick'].' '.$row['OnlineStatus'].' '.$row['Text'].'</a><br />';
			}
		}else echo 'Error';
	}else echo 'Brak kontaktów';
		
?>
<br /><br /><br />
<?php //wstawic do wypisania wiadomosci
	if($_SESSION['ID_CONV']!=0){
		$sql = 'SELECT messages.Text, messages.TimeSend, users.Nick FROM messages 
				INNER JOIN users ON messages.ID_Sender=users.ID
				WHERE messages.ID_Conversation='.$_SESSION['ID_CONV'].'
				ORDER BY messages.ID ASC LIMIT 50';
		$result = $conn->query($sql);
		$amount = @$result->num_rows;
		$conn->close();
		
		if($result && $amount>0){
			while($row = $result->fetch_assoc()){
				echo $row['TimeSend'].' '.$row['Nick'].' '.$row['Text'].'<br />'; //Time, Nick, Message, I used space to separate values
			}
		}else echo 'Error';
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pro1</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <div class="friendList">
            <aside class="aside1">
                <input class="friendList__search" type="text" placeholder="Search">
            </aside>
            <div class="friendList__list">

            </div>
        </div>
        <main class="chat">
            <div class="chat__top">
                <div class="now"></div>
            </div>
            <div class="chat__bot"></div>
            <input class="chat__text" type="text" placeholder="Write message ...">
            <button class="send" onclick="loadDoc()"><i class="fas fa-comment"></i></button>
        </main>
        <div class="last">
            <aside class="aside2"></aside>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>