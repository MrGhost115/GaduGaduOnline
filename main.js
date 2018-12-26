const inputChat = document.querySelector('.chat__text')
const btnChat = document.querySelector('.send')

const send = (e) => {
    const inputValue = inputChat.value
    if (inputValue === "") return
    console.log(inputValue)
    inputChat.value = ""


}

function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("demo").innerHTML =     
            inputChat.value =
                this.responseText;
        }
    };
    xhttp.open("GET", "send.php", true);
    xhttp.send();
}



btnChat.addEventListener('click', send)