const menuBtn = document.querySelector('header > span');
const menu = document.querySelector('.header__nav');

menuBtn.addEventListener('click', () =>{
    menu.classList.toggle('show');
});


const sendBtn=document.getElementById('send-btn');
const email=document.getElementById('email');
const message=document.getElementById('message');
const names=document.getElementById("name")

sendBtn.addEventListener('click',()=>{
    window.location.href = `mailto:${email.value}?subject=${encodeURIComponent(
        names.value
      )}&body=${encodeURIComponent(message.value+" Sincerley "+names.value)}`;
})