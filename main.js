const inputChat = document.querySelector('.two__bot--write')
const btnChat = document.querySelector('.two__bot--send')
const messSpace = document.querySelector('.two__mid--messages--space')

const send = (e) => {
    const inputValue = inputChat.value
    if (inputValue === "") return
    console.log(inputValue)
    inputChat.value = ""


}

// function loadDoc() {
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function () {
//         if (this.readyState == 4 && this.status == 200) {
//             //document.getElementById("demo").innerHTML =     
//             inputChat.value =
//                 this.responseText;
//         }
//     };
//     xhttp.open("GET", "send.php", true);
//     xhttp.send();
// }

function getMessage() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("demo").innerHTML =     
            var wartosc =
                this.responseText;
            console.log(wartosc)
        }
    };
    xhttp.open("GET", "send.php/?message=" + inputChat.value, true);
    xhttp.send();
}

btnChat.addEventListener('click', append)
btnChat.addEventListener('click', send)


//getM onclick html

function append() {
    const div = document.createElement('div')
    messSpace.appendChild(div).style.color = 'red'
    div.classList.add('rightboy')
    div.innerHTML = inputChat.value
    // console.log(div)

}
let time = setInterval(recieveMessage, 1500)

function recieveMessage() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var recieve = this.responseText;
            if (recieve != 0) {
                const div = document.createElement('div')
                messSpace.appendChild(div)
                div.innerHTML = recieve
            }
        }
    };
    xhttp.open("GET", "recieve.php/?message=1", true);
    xhttp.send();


}

//substr