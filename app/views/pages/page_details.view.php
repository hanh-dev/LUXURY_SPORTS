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
		<link rel="stylesheet" href="public/css/Details.css">

	</head>
	<body>
	<main class="app-main">
			<div class="container">
				<!-- Kết nối dữ liệu -->
				<?php
					$product = $data['Product'];
				?>
				<div class="bread-product">
					<ul class="nav justify-content-center justify-content-lg-start">
						<li>
							<a href="/">Home</a>
						</li>
						<li>
							<a href="/">Shop</a>
						</li>
						<li>
							<span><?php echo $product['Name']?> </span>
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
								<img src="<?= 'public/images/' .$product['Image'] . '.jpg'?>" alt="<?php echo $product['Name']?>">
						</div>
					</div>
					<div class="col bg-success">
						<div class="product-detail">
							<h2 class="heading-title"><?php echo $product['Name']?></h2>
							<div class="product-price">
								<span class="old-price">$99.99</span>
								<span class="new-price">$88.99</span>
							</div>
							<div class="heading-description">
								<p class="text">
									<?php echo $product['Description']?>
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
						<?php if(!empty($data['RelatedProducts'])): ?>
						<?php foreach($data['RelatedProducts'] as $relatedProduct): ?>
						<div class="product-item">
							<div class="product-img-sm">
								<img src="<?= 'public/images/' .$relatedProduct['Image'] . '.jpg'?>" alt="<?php echo $relatedProduct['Name'] ?>">
							</div>
							<div class="text-description">
								<p class="text"><?php echo $relatedProduct['Name'] ?></p>
								<span class="price">$100.00</span>
							</div>
						</div>
						<?php endforeach; ?>
						<?php else: ?>
							<p>No related products found.</p>
						<?php endif; ?>
						<button class="arrow right" id="scrollRight"><i class="fa-solid fa-arrow-right"></i></button>
						
					</div>
				</div>
			</div>
		</main>
	</body>
	</html>