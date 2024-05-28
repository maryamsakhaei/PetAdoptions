document.addEventListener("DOMContentLoaded", function () {
    let search = document.getElementById('search-breed');

    if (search != null) {
        search.addEventListener('keyup', function () {
            if (search.value.length >= 3) {
                handleSearch();
            } else if (search.value.length === 0) {
                location.reload();
            }
        });
    }

    function handleSearch() {
        let xhttp = new XMLHttpRequest();
        let value = document.getElementById('search-breed').value;
        xhttp.onload = function () {
            if (this.status == 200) {
                document.getElementById('layout').innerHTML = this.responseText;
            }
        };
        let url = "../utils/searchPetInfo.php?search=" + value;

        xhttp.open('GET', url);
        xhttp.send();
    }

});
