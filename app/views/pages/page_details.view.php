<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
   <!-- Bootstrap CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="/MVC_PROJECT/LUXURY_SPORTS/public/css/Details.css">
</head>
<body>
<main class="app-main">
		<div class="container">
			<div class="bread-product">
				<ul class="nav justify-content-center justify-content-lg-start">
					<li>
						<a href="/">Home</a>
					</li>
					<li>
						<a href="/">Shop</a>
					</li>
					<li>
						<span> Women’s Stewie Basketball All Over Print Jacket</span>
					</li>
				</ul> 
			</div>
			<!-- Row -->
			<div class="row content-1">
				<div class="col-1 bg-success">
					<button class="btn-sale">Sale!</button>
				</div>
				<div class="col bg-warning">
					<div class="product-img-lg">
						<img src="https://victeam.co/wp-content/uploads/2022/02/A38-tim-e1645301425232.jpg" alt="áo thể thao">
					</div>
				</div>
				<div class="col bg-success">
					<div class="product-detail">
						<h2 class="heading-title">Women’s Stewie Basketball All Over Print Shirt</h2>
						<div class="product-price">
							<span class="old-price">$99.99</span>
							<span class="new-price">$88.99</span>
						</div>
						<div class="heading-description">
							<p class="text">Elevate your athletic performance with our cutting-edge sports accessories. From high-performance compression sleeves to ergonomic 
								water bottles and durable sports towels, our collection is designed to enhance your comfort, style, and functionality. Whether you’re hitting the gym, 
								the track, or the field, our sports accessories are crafted for peak performance, providing the perfect blend of quality and style to fuel your passion 
								for sports.
							</p>
						</div>
						<div class="btn-update">
							<div class="quantity buttons_added">
								<input type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" id="number_subtraction" value="-">
								<input type="number" value="1" id="number_step" min="1">
								<input type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" id="number_addition" value="+">
							</div>
							<button class="btn-primary">Add To Cart</button>
						</div>
						<div class="add-to-wishist">
							<i class="fa-regular fa-heart"></i>
							<p class=text-wishist>Add to wishist</p>
						</div>
						<div class="box-detail">
							<div class="size">
								<i class="fa-solid fa-shirt"></i>
								<p>Size Guide</p>
							</div>
							<div class="ship">
								<i class="fa-solid fa-truck-fast"></i>
								<p>Ship To Home</p>
							</div>
							<div class="free">
								<i class="fa-solid fa-box"></i>
								<p>Free Pickup</p>
							</div>
						</div>
						<div class="social-media">
							<ul class="social-items">
								<li>
									<a href="#">
										<i class="fa-brands fa-facebook-f"></i>
										<p>Facebook</p>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa-brands fa-twitter"></i>
										<p>Twitter</p>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa-brands fa-pinterest-p"></i>
										<p>Printerest</p>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa-brands fa-whatsapp"></i>
										<p>Whats App</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="content-2">
				<div class="heading">
					<h2 class="heading-title">RELATED PRODUCTS</h2>
				</div>
				<div class="products">
					<button class="arrow left" id="scrollLeft"><i class="fa-solid fa-arrow-left"></i></button>

					<div class="product-item">
						<div class="product-img-sm">
							<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRfC_McqGUpmKtfhTS4oK53A0h6N-Lu0YvBkg&s" alt="">
						</div>
						<div class="text-description">
							<p class="text">
								Toronto Raptors Nike Kids’ OG Anunoby Swingman
							</p>
							<span class="price">$100.00</span>
						</div>
					</div>
					<div class="product-item">
						<div class="product-img-sm">
							<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRfC_McqGUpmKtfhTS4oK53A0h6N-Lu0YvBkg&s" alt="">
						</div>
						<div class="text-description">
							<p class="text">
								Toronto Raptors Nike Kids’ OG Anunoby Swingman
							</p>
							<span class="price">$100.00</span>
						</div>
					</div>
					<div class="product-item">
						<div class="product-img-sm">
							<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRfC_McqGUpmKtfhTS4oK53A0h6N-Lu0YvBkg&s" alt="">
						</div>
						<div class="text-description">
							<p class="text">
								Toronto Raptors Nike Kids’ OG Anunoby Swingman
							</p>
							<span class="price">$100.00</span>
						</div>
					</div>
					<div class="product-item">
						<div class="product-img-sm">
							<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRfC_McqGUpmKtfhTS4oK53A0h6N-Lu0YvBkg&s" alt="">
						</div>
						<div class="text-description">
							<p class="text">
								Toronto Raptors Nike Kids’ OG Anunoby Swingman
							</p>
							<span class="price">$100.00</span>
						</div>
					</div>
					<button class="arrow right" id="scrollRight"><i class="fa-solid fa-arrow-right"></i></button>
					
				</div>
				<!-- <div class="navigation-left-right">
					<button class="arrow left" id="scrollLeft">&lt;</button>
					<button class="arrow right" id="scrollRight">&gt;</button>

				</div> -->
			</div>
		</div>
    </main>
</body>
</html>