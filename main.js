const inputChat = document.querySelector('.two__bot--write')
const btnChat = document.querySelector('.two__bot--send')

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

function getMessage() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("demo").innerHTML =     
            inputChat.value =
                this.responseText;
        }
    };
    xhttp.open("GET", "send.php/?message=".input.value, true);
    xhttp.send();
}
setInterval(getMessage, 1000)

btnChat.addEventListener('click', send)