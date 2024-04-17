// Useful elements

// Dropdown menu
function dropdownMenuManager(){
    let dropdownMenu = document.getElementById('dropdown-menu');

    if(dropdownMenu.classList.contains('active')) {

        dropdownMenu.classList.remove('active');

    } else {

        dropdownMenu.classList.add('active');

    }
}