// Dropdown menu and moves menu manager
window.onclick = function(event) {

    let navButton = document.getElementById('nav-btn');
    let navMenu = document.getElementById('nav-menu');
    let moveButton = document.getElementById('move-btn');
    let moveMenu = document.getElementById('move-menu');
    let moveClose = document.getElementById('move-close');

    if (navButton.contains(event.target)) {

        if (! navMenu.classList.contains('active')) {

            navMenu.classList.add('active');

        } else {

            navMenu.classList.remove('active');

        }

    } else if (! navMenu.contains(event.target)) {

        if (navMenu.classList.contains('active')) {

            navMenu.classList.remove('active');

        }

    }

    if (moveButton != null && moveButton.contains(event.target)) {

        if (! moveMenu.contains(event.target)) {
            
            if (! moveMenu.classList.contains('active')) {

                moveMenu.classList.add('active');

            } else {

                moveMenu.classList.remove('active');

            }
        } else if (moveClose != null && moveMenu != null &&  moveClose.contains(event.target)) {
            
            if (moveMenu.classList.contains('active')) {

                moveMenu.classList.remove('active');
    
            }
        }

    } else if (moveMenu != null && ! moveMenu.contains(event.target)) {

        if (moveMenu.classList.contains('active')) {

            moveMenu.classList.remove('active');

        }
    }

}



// To generate the color of the pokemon card in the pokedexDresseur page
// Sets the main color of an image to the background of the div (for pokemon cards)
function setMainColorToBackground(id) {
    let img = document.getElementById("img-"+id);
    let card = document.getElementById("card-background-"+id);

    let blockSize = 5,
        defaultRGB = {r:0,g:0,b:0},
        canvas = document.createElement('canvas'),
        context = canvas.getContext && canvas.getContext('2d'),
        data, width, height,
        i = -4,
        length,
        allRGB = new Map();

    const whiteThreshold = 255,
          blackThreshold = 55;

    if (!context) {
        return defaultRGB;
    }

    height = canvas.height = img.naturalHeight || img.offsetHeight || img.height;
    width = canvas.width = img.naturalWidth || img.offsetWidth || img.width;

    context.drawImage(img, 0, 0);

    try {
        data = context.getImageData(0, 0, width, height);
    } catch(e) {
        // Security error, img on diff domain
        return defaultRGB;
    }

    length = data.data.length;


    // Counts the number of occurrences of each color between the two thresholds
    while ((i += blockSize * 4) < length) {
        let currentRGB = {
            r: data.data[i],
            g: data.data[i + 1],
            b: data.data[i + 2]
        };
        
        let colorString = `rgb(${currentRGB.r},${currentRGB.g},${currentRGB.b})`;
    
        if ((currentRGB.r > blackThreshold && currentRGB.g > blackThreshold && currentRGB.b > blackThreshold) && (currentRGB.r < whiteThreshold && currentRGB.g < whiteThreshold && currentRGB.b < whiteThreshold)) {
            if (allRGB.has(colorString)) {
                allRGB.set(colorString, allRGB.get(colorString) + 1);
            } else {
                allRGB.set(colorString, 1);
            }
        }
    }

    // Keeps the color with the most occurrences 
    let mainColor = null;
    let mainCount = 0;

    allRGB.forEach((count, color) => {
        if (count > mainCount) {
            mainColor = color;
            mainCount = count;
        }
    });
    
    card.style.background = mainColor;
}


// To chose between displaying shiny version or not this must work all the time
function shinyToNormal() {
    let img = document.getElementById("img-pokemon");
    img.src = img.src.replace("_shiny", "");
}

function normalToShiny() {
    let img = document.getElementById("img-pokemon");
    img.src = img.src.replace("pokemon_sugimori", "pokemon_sugimori_shiny");
}



// To handle the image switch on edit pokedexDresseur page
function pokemonSwitch(pokedexDresseur) {
    let input = document.getElementById("pokemon-input");
    let inputValue = input.value;
    let img = document.getElementById("pokemon-img");
    let seenInput = document.getElementById("seen");
    let caughtInput = document.getElementById("caught");
    let form = document.getElementById("edit-form");

    for (let key in pokedexDresseur){
        // If the pokemon exists
        if (inputValue == pokedexDresseur[key]["nom"]) {
            newPokemonID = pokedexDresseur[key]["id_pokemon"]
            imgPath = "/ressources/images/pokemons/pokemon_sugimori/" + pokedexDresseur[key]["id_pokemon"] + ".png";
            seen = pokedexDresseur[key]["stats"][0]["nbVue"];
            caught = pokedexDresseur[key]["stats"][0]["nbAttrape"];

            img.src = imgPath;
            seenInput.value = seen;
            caughtInput.value = caught;
            form.action = "./update.php?id_pokemon=" + newPokemonID;

            console.log(form);
            return;
        }
    }

    imgPath = '/ressources/images/pokemons/unknown-pokemon.png'
    seenInput.value = 0;
    caughtInput.value = 0;
    img.src = imgPath;
    form.action = "";
}


// Plus and minus button in edit.php
function plusMinusHandler(id) {
    let seenInput = document.getElementById("seen");
    let caughtInput = document.getElementById("caught");
    
    if(id == "seen-minus") {
        if(seenInput.value > 0){
            seenInput.value = parseInt(seenInput.value) - 1;
        }
    }

    if(id == "seen-plus") {
        console.log(seenInput.value);
        seenInput.value = parseInt(seenInput.value) + 1;
    }

    if(id == "caught-minus") {
        if(caughtInput.value > 0){
            caughtInput.value = parseInt(caughtInput.value) - 1;
        }
    }

    if(id == "caught-plus") {
        caughtInput.value = parseInt(caughtInput.value) + 1;
    }

}