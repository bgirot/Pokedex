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

// Calculates the average color of the image and the average color of the most
// comon colors
function setMainColorToBackground(id) {
    let img = document.getElementById("img-"+id);
    let card = document.getElementById("card-"+id);

    let blockSize = 5,              // only visit every 5 pixels
        defaultRGB = {r:0,g:0,b:0}, // for non-supporting envs
        canvas = document.createElement('canvas'),
        context = canvas.getContext && canvas.getContext('2d'),
        data, width, height,
        i = -4,
        length,
        rgb = {r:0,g:0,b:0},
        count = 0;

    if (!context) {
        return defaultRGB;
    }

    height = canvas.height = img.naturalHeight || img.offsetHeight || imgEl.height;
    width = canvas.width = img.naturalWidth || img.offsetWidth || imgEl.width;

    context.drawImage(img, 0, 0);

    try {
        data = context.getImageData(0, 0, width, height);
    } catch(e) {
        /* security error, img on diff domain */
        return defaultRGB;
    }

    length = data.data.length;

    while ( (i += blockSize * 4) < length ) {

        ++count;

        rgb.r += data.data[i];
        rgb.g += data.data[i+1];
        rgb.b += data.data[i+2];
    }
    

    // ~~ used to floor values
    rgb.r = ~~(rgb.r/count);
    rgb.g = ~~(rgb.g/count);
    rgb.b = ~~(rgb.b/count);

    card.style.background = "rgb(" + rgb.r + "," + rgb.g  + "," + rgb.b + ")";
}