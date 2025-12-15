let menu = document.querySelector('#menu-icon');
let navmenu = document.querySelector('.navmenu');

if (menu && navmenu) {
    menu.onclick = () => {
        menu.classList.toggle('bx-x');
        navmenu.classList.toggle('open');
    }
}
