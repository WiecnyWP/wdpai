const search = document.querySelector('input[placeholder="Search"]');
const searchMobile = document.querySelector('.navigation-mobile [placeholder="Search"]');
const artContainer = document.querySelector(".projects");

search.addEventListener("keyup", handleSearch);
searchMobile.addEventListener("keyup", handleSearch);

function handleSearch(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        const data = {search: this.value};
        fetch("/searchArt", {
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        }).then(function (response){
            return response.json();
        }).then(function (projects){
            artContainer.innerHTML = "";
            loadArts(projects)
        });
    }
}


function loadArts(projects) {
    projects.forEach(project => {
        console.log(project);
        createArt(project);
    });
}

function createArt(project) {
    const template = document.querySelector("#project-template");
    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = `/public/uploads/${project.image}`;

    const type = clone.querySelector("#p1");
    type.innerHTML = project.type;

    const name = clone.querySelector("#p2");
    name.innerHTML = project.name;

    const city = clone.querySelector("#p3");
    city.innerHTML = project.city;

    artContainer.appendChild(clone);
}
