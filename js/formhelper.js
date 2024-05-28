var nextBtn = document.getElementById("nextbtn");
var backBtn = document.getElementById("backbtn");
var createBtn = document.getElementById("createbtn");
var error = document.getElementById("error");

var requiredFields = document.querySelector(".required-fields");
var optionalFields = document.querySelector(".optional-fields");

var nameField = document.getElementById("name");
var speciesField = document.getElementById("species");
var spaceField = document.getElementById("space");

function showError(message) {
    error.textContent = message;
}

function clearError() {
    error.textContent = "";
}


nextBtn.addEventListener("click", function () {

    if (nameField.value.trim() === "") {
        showError("Please, add a pet name");
        return;
    }
    if (speciesField.value === "") {
        showError("Please, select a pet species");
        return;
    }
    if (spaceField.value === "") {
        showError("Please, add the amount of space needed");
        return;
    }

    clearError();

    nextBtn.setAttribute("hidden", "");
    requiredFields.setAttribute("hidden", "");

    optionalFields.removeAttribute("hidden");
    createBtn.removeAttribute("hidden");
    backBtn.removeAttribute("hidden");

});

backBtn.addEventListener("click", function () {

    optionalFields.setAttribute("hidden", "");
    createBtn.setAttribute("hidden", "");
    backBtn.setAttribute("hidden", "");

    nextBtn.removeAttribute("hidden");
    requiredFields.removeAttribute("hidden");

})