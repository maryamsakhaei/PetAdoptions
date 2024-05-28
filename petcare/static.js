const arr = [{
        img: src = "../images/pets/dog.jpg",
        name: "Dog",
        description: "If you want take care of me, You can click read more.",
        carebtn: "dog.php",
        traininbtn: "trainingdog.php",

    },
    {
        img: src = "../images/pets/bird.jpg",
        name: "Bird",
        description: "If you want take care of me, You can click read more.",
        carebtn: "bird.php",
        traininbtn: "trainingbird.php"
    },
    {
        img: src = "../images/pets/cat.jpg",
        name: "Cat",
        description: "If you want take care of me, You can click read more.",
        carebtn: "cat.php",
        traininbtn: "trainingcat.php"
    },
    {
        img: src = "../images/pets/fish.jpg",
        name: "Fish",
        description: "If you want take care of me, You can click read more.",
        carebtn: "fish.php",
        traininbtn: "trainingfish.php"
    }
];
console.log(arr);
let out = document.getElementById("content")

for (let obj of arr) {
    out.innerHTML += `
            <div class="card">
                <img src="${obj.img}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">${obj.name}</h5>
                    <p class="card-text">${obj.description}</p>
                    <a href="${obj.carebtn}" class="btn btn-primary btnStatic">Care </a>
                <hr>
                    <a href="${obj.traininbtn}" class="btn btn-primary btnStatic">Training & Tips </a>
                </div>
            </div>`
}