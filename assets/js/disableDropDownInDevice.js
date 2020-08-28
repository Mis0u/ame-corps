let li = document.querySelector('.dropdown');
let dropdown = document.querySelector('.dropdown-menu');
let widthDevice = document.documentElement.clientWidth;

if (widthDevice <= 768) {
    li.classList.remove('dropdown');
    dropdown.classList.remove('dropdown-menu');
    dropdown.style.position = "static";
    dropdown.style.transform = 'unset'
}