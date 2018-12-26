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
