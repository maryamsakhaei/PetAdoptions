var createAcc = document.getElementById("createAcc");

var fname = document.getElementById("fname");
var lname = document.getElementById("lname");
var dob = document.getElementById("date");
var emailPass = document.getElementById("emailPass");


if (emailPass.getAttribute("hidden") === null) {
    var email = document.getElementById("email");
    var password = document.getElementById("password");
} else {
    var email = null;
    var password = null;
}

var address = document.getElementById("address");

createAcc.addEventListener("click", function () {

    var invalidFields = [];

    if (fname.value.trim() === "") {
        fname.setCustomValidity("Please, enter your first name");
        invalidFields.push(fname);
    } else if (fname.value.trim().length < 3) {
        fname.setCustomValidity("Name must have at least 3 characters.");
        invalidFields.push(fname);
    } else if (!fname.value.trim().match(/^[a-zA-ZäöüÄÖÜß\s]+$/)) {
        fname.setCustomValidity("Name must contain only letters and spaces.");
    } else {
        fname.setCustomValidity("");
    }

    if (lname.value.trim() === "") {
        lname.setCustomValidity("Please, enter your last name");
        invalidFields.push(lname);
    } else if (lname.value.trim().length < 3) {
        lname.setCustomValidity("Last name must have at least 3 characters.");
        invalidFields.push(lname);
    } else if (!lname.value.trim().match(/^[a-zA-ZäöüÄÖÜß\s]+$/)) {
        lname.setCustomValidity("Last name must contain only letters and spaces.");
    } else {
        lname.setCustomValidity("");
    }

    if (dob.value.trim() === "") {
        dob.setCustomValidity("Date of birth can't be empty!");
        invalidFields.push(dob);
    } else {
        dob.setCustomValidity("");
    }

    if (address.value.trim() === "") {
        address.setCustomValidity("Please enter your Address");
        invalidFields.push(address);
    } else if (address.value.trim().length < 3) {
        address.setCustomValidity("Address must have at least 3 characters.");
        invalidFields.push(address);
    } else {
        address.setCustomValidity("");
    }
    if (password !== null) {
        if (password.value.trim() === "") {
            password.setCustomValidity("Please enter your password");
            invalidFields.push(password);
        } else {
            password.setCustomValidity("");
        }
    }
    if (email !== null) {
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            email.setCustomValidity("Please enter a valid email address");
            invalidFields.push(email);
        } else {
            email.setCustomValidity("");
        }
    }

    if (invalidFields.length > 0) {
        invalidFields[0].focus();
        return;
    }

});
if (email !== null) {
    email.addEventListener('keyup', verify);

    function verify() {
        let xhttp = new XMLHttpRequest();
        let value = email.value;
        xhttp.onload = function () {
            if (this.status == 200) {
                document.getElementById('emailError').innerHTML = this.responseText;
                console.log(this.responseText);
            }
        };
        xhttp.open("GET", "../utils/verify.php?email=" + value);
        xhttp.send();
    }
}
