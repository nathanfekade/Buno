const menuBtn = document.querySelector('header > span');
const menu = document.querySelector('.header__nav');

menuBtn.addEventListener('click', () =>{
    menu.classList.toggle('show');
});
