const search = document.querySelector('input[placeholder="Search"]');
const searchMobile = document.querySelector('.navigation-mobile [placeholder="Search"]');
const artContainer = document.querySelector(".projects");

if(search){
    search.addEventListener("keyup", handleSearch);
}
if(searchMobile){
    searchMobile.addEventListener("keyup", handleSearch);
}

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
        createArt(project);
    });
}

function saveRate(event) {
    event.preventDefault();
    const data = {
        id_art: event.currentTarget.closest('div').querySelector('[name="id_art"]').value,
        id_user: event.currentTarget.closest('div').querySelector('[name="id_user"]').value,
        rate: event.currentTarget.dataset.rate
    }

    const starWrapper = event.currentTarget.closest('div');
    starWrapper.style.pointerEvents = 'none';
    fetch(`/saveRate`, {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.text();
    }).then(response => {
            const stars = [...starWrapper.querySelectorAll('[data-rate]')].reverse();
            for(let i = 0; i < response; i++){
                stars[i].classList.add('active');
            }
        })

}

function createArt(project) {
    fetch(`/checkRateIsset`, {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({id_art: project.id_art})
    }).then(function (response){
        return response.json();
    }).then(response => {

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

        const starWrapper = clone.querySelector('.star-wrapper');
        starWrapper.querySelector('[name="id_art"]').value = project.id_art;

        const stars = [...starWrapper.querySelectorAll('[data-rate]')].reverse();

        if(response.rate !== false){
            starWrapper.style.pointerEvents = 'none';
            for(let i = 0; i < response.rate; i++){
                stars[i].classList.add('active');
            }
        }
        else{
            stars.forEach(star => star.closest('a').addEventListener('click', saveRate))
        }

        artContainer.appendChild(clone);
    })
}

document.querySelectorAll('[data-rate]').forEach(link => link.addEventListener('click', saveRate));