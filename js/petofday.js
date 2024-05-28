const collapseButton = document.getElementById("collapseButton");
const collapseExample = document.querySelector(collapseButton.getAttribute("href"));

collapseExample.addEventListener("show.bs.collapse", function () {
    collapseButton.textContent = "hide Pet of the day"; // Expanded
});

collapseExample.addEventListener("hide.bs.collapse", function () {
    collapseButton.textContent = "See pet of the day"; // Collapsed
});