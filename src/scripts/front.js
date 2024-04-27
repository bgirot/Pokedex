// Dropdown menu manager
window.onclick = function(event) {

    let navButton = document.getElementById('nav-btn');
    let navMenu = document.getElementById('nav-menu');

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

}

// To generate the color of the pokemon card in the pokedex page
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