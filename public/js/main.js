"use strict";

window.addEventListener("load", function() 
{
  console.log("works");

  //toggle navbar
  let mainNav = document.getElementById("js-menu");
  let navBarToggle = document.getElementById("js-navbar-toggle");

  navBarToggle.addEventListener("click", function() {
    mainNav.classList.toggle("active");
  });  
});


function formToggle(id) 
{
  let formAppear = document.getElementById(id);
  formAppear.style.display !== 'block' ? formAppear.style.display = 'block' : formAppear.style.display = 'none' 
}

function promHide(id) 
{
  document.getElementById(id).style.display = "none";
}

function confirmIt() 
{
  location.reload();
  //window.location.href = window.location.pathname + window.location.search + window.location.hash;
  return confirm('Are you sure you want to do it?');
}

function showCart(id) 
{
  let cart = document.getElementById(id)
  cart.style.display !== 'block' ? cart.style.display = 'block' : cart.style.display = 'none';
}

// Facebook like and share
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.0';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));