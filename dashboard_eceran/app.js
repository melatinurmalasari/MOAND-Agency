let openShopping = document.querySelector('.btn-cart');
let closeShopping = document.querySelector('.btn-cancel');
let body = document.querySelector('body');


openShopping.addEventListener('click', ()=>{
    body.classList.add('active');
})
closeShopping.addEventListener('click', ()=>{
    body.classList.remove('active');
})

