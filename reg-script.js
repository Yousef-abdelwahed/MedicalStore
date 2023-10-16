function checkPasswords() {
    var password1 = document.getElementById("pas1").value;
    var password2 = document.getElementById("pas2").value;

    if (password1 === password2) {
       return;
    } else {
        window.alert("ERROR");
    }
}