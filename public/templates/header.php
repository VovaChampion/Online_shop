<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>LikeBatman</title>
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/product_detail.css">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	
	<link href="https://fonts.googleapis.com/css?family=Alegreya" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="js/main.js"></script>
	<!-- <script src="js/product_detail.js"></script> -->
	<script src="js/cart.js"></script>
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
</head>

<body>
	<div class="header">
		<h1 id="company_name" class="company_name"> 
		<a href="home" onclick="deleteCookie();" style="color: black;text-decoration: none;"> LikeBatman <img src="https://img.icons8.com/office/40/000000/batman-old.png"></a></h1><br>
		
		<form class="search-form">
			<input type="search" name="search" placeholder="Search ..." class="search-input">
			<button type="submit" class="search-btn">Search</button>
		</form>

		<!-- MARK shopping cart on the top -->
		<div class="cart-red" onclick="showCart('shopping_cart');">
			<i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
			<span id="itemCount">0</span>
		</div>
	</div>   

	<nav class="navbar">
		<span class="navbar-toggle" id="js-navbar-toggle"><i class="fas fa-bars"></i> </span>
		<a href="#" class="logo"><img class="image_product" src="https://img.icons8.com/office/40/000000/batman-old.png" alt="batman"></a>
		<ul class="main-nav" id="js-menu">
			<li><a href="home" class="nav-links">Home</a></li>
			<li><a href="home" class="nav-links">Products</a>
				<ul class="dropdown" aria-label="submenu">
					<li><a href="home">Cool products</a></li>
					<li><a href="home">Best products</a></li>
					<li><a href="home">What's up!</a></li>
				</ul>
			</li>
			<li><a href="about" class="nav-links">About Us</a></li>
			<li><a href="contact" class="nav-links">Contact Us</a></li>
			<li><a href="blog" class="nav-links">Blog</a></li>
		</ul>
	</nav>