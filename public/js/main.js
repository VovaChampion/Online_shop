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

// Weather function

const key = '15b36c1878779d280dd8a14efa4c8c45';
if(key=='') document.getElementById('temp').innerHTML = ('Remember to add your api key!');

function weatherBallon( cityID ) {
	fetch('https://api.openweathermap.org/data/2.5/weather?id=' + cityID+ '&appid=' + key)  
	.then(function(resp) { return resp.json() }) // Convert data to json
	.then(function(data) {
		drawWeather(data);
	})
	.catch(function() {
		// catch any errors
	});
}
function drawWeather( d ) {
  var celcius = Math.round(parseFloat(d.main.temp)-273.15);
	var fahrenheit = Math.round(((parseFloat(d.main.temp)-273.15)*1.8)+32);
  var desc = d.weather[0].description; 
	
	document.getElementById('desc').innerHTML = desc;
	document.getElementById('temp').innerHTML = celcius + '&deg;';
	document.getElementById('location').innerHTML = d.name;
  
  if( description.indexOf('rain') > 0 ) {
  	document.body.className = 'rainy';
  } else if( desc.indexOf('cloud') > 0 ) {
  	document.body.className = 'cloudy';
  } else if( desc.indexOf('sunny') > 0 ) {
  	document.body.className = 'sunny';
  } else {
  	document.body.className = 'clear';
  }
}
window.onload = function() {
	weatherBallon( 2673730 );
}