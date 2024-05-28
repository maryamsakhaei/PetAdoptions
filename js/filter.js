let speciesCheckboxes = document.querySelectorAll(".species-checkbox");
let sizeCheckboxes = document.querySelectorAll(".size-checkbox");
let vaccineCheckbox = document.querySelector(".vaccine-checkbox");
let status_all = document.getElementById("radio1");
let status_available = document.getElementById("radio2");
let status_adopted = document.getElementById("radio3");


speciesCheckboxes.forEach(checkbox => {
    checkbox.addEventListener("change", function () {
        updateDisplay();
    });
});

sizeCheckboxes.forEach(checkbox => {
    checkbox.addEventListener("change", function () {
        updateDisplay();
    });
});

vaccineCheckbox.addEventListener("change", function () {
    updateDisplay();
});

status_all.addEventListener("click", function () {
    toggleFilter("status", "all");
});

status_available.addEventListener("click", function () {
    toggleFilter("status", 1);
});

status_adopted.addEventListener("click", function () {
    toggleFilter("status", 0);
});

let filters = {};

function toggleFilter(filter, value) {
    if (filters[filter] === value) {
        delete filters[filter];
    } else {
        filters[filter] = value;
    }
    updateDisplay();
}

function updateDisplay() {
    let speciesFilters = Array.from(speciesCheckboxes)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.getAttribute("data-filter"));

    if (speciesFilters.length > 0) {
        filters.species = speciesFilters.join(",");
    } else {
        delete filters.species;
    }

    let sizeFilters = Array.from(sizeCheckboxes)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.getAttribute("data-filter"));

    if (sizeFilters.length > 0) {
        filters.size = sizeFilters.join(",");
    } else {
        delete filters.size;
    }

    if (vaccineCheckbox.checked) {
        filters.vaccinated = "1"; // Value for checked
    } else {
        delete filters.vaccinated; // Remove the property if not checked
    }

    let filterString = Object.keys(filters)
        .map(filter => encodeURIComponent(filter) + "=" + encodeURIComponent(filters[filter]))
        .join("&");

    let xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        if (this.status == 200) {
            document.getElementById('layout').innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "../utils/displayPets.php?" + filterString);
    xhttp.send();
}
jQuery(document).ready(function ($) {
    $('.filter-block h4').on('click', function () {
        $(this).toggleClass('closed').siblings('.filter-content').slideToggle(300);
    })

    $(window).on('scroll', function () {
        (!window.requestAnimationFrame) ? fixGallery() : window.requestAnimationFrame(fixGallery);
    });

    function fixGallery() {
        var offsetTop = $('.cd-main-content').offset().top,
            scrollTop = $(window).scrollTop();
        (scrollTop >= offsetTop) ? $('.cd-main-content').addClass('is-fixed') : $('.cd-main-content').removeClass('is-fixed');
    }
});

/* -------------------------------- 

Reset button

-------------------------------- */

let reset_btn = document.getElementById("reset-btn");

reset_btn.addEventListener("click", function () {
    resetFilters();
    updateDisplay();
});

function resetFilters() {
    filters = {}; // Clear all filters
    resetCheckboxes(speciesCheckboxes);
    resetCheckboxes(sizeCheckboxes);
    vaccineCheckbox.checked = false;
    status_all.checked = true;
}

function resetCheckboxes(checkboxes) {
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
}