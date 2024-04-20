// Dropdown menu manager
window.onclick = function(event) {
    console.log(event.target);

    let navButton = document.getElementById('nav-btn');
    let navMenu = document.getElementById('nav-menu');

    if (navButton.contains(event.target)) {

        if (! navMenu.classList.contains('active')) {

            navMenu.classList.add('active');

        } else {

            navMenu.classList.remove('active');

        }

    } else if (! navMenu.contains(event.target)) {

        console.log("ok");

        if (navMenu.classList.contains('active')) {

            navMenu.classList.remove('active');

        }

    }

}