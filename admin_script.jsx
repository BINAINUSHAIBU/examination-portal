let footer = document.querySelector('footer');
let body = document.body;
let profile = document.querySelector('.header .flex .profile');
let searchForm = document.querySelector('.header .flex .search-form');
let sideBar = document.querySelector('.side-bar');


document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    searchForm.classList.remove('active');
}

document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
    searchForm.classList.remove('active');
}

document.querySelector('#menu-btn').onclick = () =>{
    sideBar.classList.toggle('active');
    body.classList.toggle('active');
    footer.classList.toggle('active');
}

window.onscroll = () =>{
    profile.classList.remove('active');
    searchForm.classList.remove('active');
    

}