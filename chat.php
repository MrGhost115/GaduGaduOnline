<?php
	session_start();
	
	$_SESSION['ID_CONV']=1;
	
	if($_SESSION['logged']==1){
		require_once 'db_connect.php';
		$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = 'SELECT users.Nick, users.OnlineStatus FROM participants 
		LEFT JOIN users ON participants.ID_User=users.ID
		LEFT JOIN conversations ON participants.ID_Conversation=conversations.ID
		WHERE participants.ID_Conversation='.$_SESSION['ID_CONV'].' 
		AND users.Nick!="'.$_SESSION['nick'].'"';
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$NickFriend = $row['Nick'];
		$OnlineStatus = $row['OnlineStatus'];
		
	}else{
		header("Location: index.php");
		die();
	}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mess.pl</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="mess.css">
</head>

<body>
    <div class="wrapper">
        <!-- one -->
        <div class="one">
            <div class="one__top">
                <h1>Mess.pl</h1>
            </div>
            <div class="one__input">
                <input class="one__input--search" type="text" placeholder=" Search"> <!-- search -->
                <i class="fas fa-search"></i>
            </div>
            <div class="one__list">
                <div class="one__list--friend"></div> <!-- friend list -->
            </div>
        </div>
        <!-- two -->
        <div class="two">
            <div class="two__top"></div>
            <div class="two__mid">
                <div class="two__mid--status">
                    <div class="user--name"><?php //wstawic do wypisania nicku rozmowcy
	echo $NickFriend;
?></div>
                    <div class="user--status">
					<?php //wstawic do wypisania statusu rozmowcy
	echo $OnlineStatus; // 1 -  Online, 0 - Offline
?>
					</div>

                </div>
                <div class="two__mid--messages">
                    <div class="two__mid--messages--space">
					<?php //wstawic do wypisania wiadomosci
	$sql = 'SELECT messages.Text, messages.TimeSend, users.Nick FROM messages 
			INNER JOIN users ON messages.ID_Sender=users.ID
			WHERE messages.ID_Conversation='.$_SESSION['ID_CONV'].'
			ORDER BY messages.ID DESC LIMIT 50';
	$result = $conn->query($sql);
	$amount = @$result->num_rows;
	$conn->close();
	
	if($result && $amount>0){
		while($row = $result->fetch_assoc()){
			echo $row['TimeSend'].' '.$row['Nick'].' '.$row['Text'].'<br />'; //Time, Nick, Message, I used space to separate values
		}
	}else echo 'Error';
?>
					</div>
                </div> <!-- messages -->
                <div class="two__bot">
                    <input class="two__bot--write" type="text" placeholder="Write message ..."> <!-- write -->
                    <button class="two__bot--send" onclick="getMessage();" >Send</button> <!-- send -->
                </div>

            </div>
        </div>

        <!-- three -->
        <div class="three">
            <div class="three__top"></div>
            <div class="three__mid"></div>
        </div>
    </div>
    <!-- color change -->
    <div class="color">

        <div class="part white"></div>
        <div class="part black"></div>

    </div>
    <script src="main.js"></script>
</body>

</html>