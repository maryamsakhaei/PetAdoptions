let btn = document.getElementById("markread");

btn.addEventListener("click", function () {
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        if (this.status == 200) {
            document.getElementById('layout').innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "../messages/markread.php?id=" + msgid);
    xhttp.send();
});