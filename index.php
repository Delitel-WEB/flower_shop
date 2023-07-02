<?php $main_page = True; 
	
	include("db/db.php");
	$db = new MYSQLither();

	$recomended_products = $db->get_last_10_purchases();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Цветочек</title>
	<link rel="icon" href="img/flower.ico">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/slick.css">
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/scroll_detect.js"></script>
	<script src="js/slick.min.js"></script>
	<script src=js/custom_slick.js></script>
	<script src="js/easy-toggler.min.js"></script>

</head>
<body class="d-flex flex-column min-vh-100">

	
	<?php 
		include_once("header.php");
		include_once("modal_login.php");
	?>

	<div class="hero">
		<div class="slides">
			<div>
				<div class="titles center bgf">
					<div class="inner">
						<h1>Уют</h1>
						<p>Наши цветы добавят уют вашему дому или двору!</p>
					</div>
				</div>
				<img src="img/hero_1.jpg" alt="">
			</div>
			<div>
				<div class="titles center bgf">
					<div class="inner">
						<h1>Разнообразие</h1>
						<p>У нас вы можете подобрать цветы на любой вкус.</p>
					</div>
				</div>
				<img src="img/hero_4.jpg" alt="">
			</div>
			<div>
				<div class="titles left-side bgf">
					<div class="inner">
						<h1>Комфорт</h1>
						<p>Добавьте комфорт своему дому</p>
					</div>
				</div>
				<img src="img/hero_5.jpg" alt="">
			</div>
			<div>
				<div class="titles left-side bgf black-color">
					<div class="inner">
						<h1>Запах счастья</h1>
						<p>Любой цветок который вы купите будет радовать вас прекрасным ароматом каждый день.</p>
					</div>
				</div>
				<img src="img/hero_7.jpeg" alt="">
			</div>
			<div>
				<div class="titles left-side bgf ">
					<div class="inner">
						<h1>Красота природы</h1>
					</div>
				</div>
				<img src="img/hero_9.jpg" alt="">
			</div>
			<div>
				<div class="titles right-side bgf">
					<div class="inner">
						<h1>Лофт</h1>
						<p>Цветы помогут вам украсить скучный интерьер дома.</p>
					</div>
				</div>
				<img src="img/hero_2.jpg" alt="">
			</div>
		</div>
		<div class="hider">
		</div>
	</div>
	<main class="container">

		<div class="advantages">
			<h1 class="text-center">Наши преимущества</h1>
			<div class="row justify-content-center">
				<div class="col-sm-4 col-md-4 advantages-cart">
					<svg class="cart-icon" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 489.9 489.9" style="enable-background:new 0 0 489.9 489.9;" xml:space="preserve">
						<circle cx="88.3" cy="361.15" r="43.5"/>
						<circle cx="388.7" cy="361.15" r="43.5"/>
						<path d="M396.9,133.75h-89.8v227h18.3c0-35,28.4-63.4,63.4-63.4s63.4,28.4,63.4,63.4h37.7v-98.7L396.9,133.75z M359.9,293.55
							h-22.5c-5.4,0-9.7-4.3-9.7-9.7c0-5.4,4.3-9.7,9.7-9.7h22.5c5.4,0,9.7,4.3,9.7,9.7C370,289.25,365.4,293.55,359.9,293.55z
							 M332,254.25v-95.6h52.5l69.2,95.6H332z"/>
						<path d="M0,361.15h24.9c0-35,28.4-63.4,63.4-63.4s63.4,28.4,63.4,63.4h135.6v-71.5H0V361.15z"/>
						<path d="M0,85.25v56h58.7v-9.1c0-16.4,19.1-25.5,31.8-15.1l58.6,47.6c9.6,7.8,9.6,22.5-0.1,30.3l-58.6,47.3
							c-12.8,10.3-31.8,1.2-31.8-15.2v-9.2H0v52.5h287.2v-185H0V85.25z"/>
						<polygon points="78.6,225.95 136.1,179.65 78.6,133.05 78.6,160.95 0,160.95 0,198.35 78.6,198.35 			"/>
					</svg>

					<div class="cart-content">
						<h2>Быстрая доставка</h2>
						<p>Мы доставляем наши цветы в течении 2-ух дней с момента заказа. В <b>любую</b> точку страны!</p>
					</div>
				</div>
				<div class="col-sm-4 col-md-4 advantages-cart">
					<svg class="cart-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
							<path d="M189.035,166.712c-12.308,0-22.322,10.014-22.322,22.322s10.014,22.322,22.322,22.322s22.322-10.015,22.322-22.322
								C211.357,176.726,201.343,166.712,189.035,166.712z"/>

							<path d="M322.967,300.644c-12.308,0-22.322,10.014-22.322,22.322c0,12.308,10.014,22.322,22.322,22.322
								c12.308,0,22.322-10.014,22.322-22.322C345.289,310.658,335.274,300.644,322.967,300.644z"/>

							<path d="M507.154,244.22l-43.447-43.875l15.689-59.721c2.333-8.881-2.923-17.984-11.78-20.403l-59.564-16.273l-16.273-59.564
								c-2.42-8.857-11.52-14.114-20.403-11.78l-59.72,15.69L267.78,4.846c-6.525-6.461-17.036-6.461-23.56,0l-43.875,43.448
								l-59.721-15.689c-8.883-2.334-17.983,2.923-20.403,11.78l-16.273,59.564l-59.564,16.273c-8.857,2.42-14.113,11.523-11.78,20.403
								l15.689,59.721L4.846,244.22c-6.461,6.525-6.461,17.036,0,23.56l43.448,43.875l-15.689,59.721
								c-2.333,8.881,2.923,17.984,11.78,20.403l59.564,16.273l16.273,59.564c2.42,8.857,11.519,14.114,20.403,11.78l59.721-15.689
								l43.875,43.448c3.262,3.231,7.521,4.846,11.78,4.846c4.259,0,8.518-1.615,11.78-4.846l43.875-43.448l59.721,15.689
								c8.882,2.331,17.983-2.923,20.403-11.78l16.273-59.564l59.564-16.273c8.857-2.42,14.113-11.523,11.78-20.403l-15.689-59.721
								l43.447-43.875C513.615,261.256,513.615,250.745,507.154,244.22z M133.23,189.034c0-30.771,25.034-55.805,55.805-55.805
								s55.805,25.034,55.805,55.805s-25.034,55.805-55.805,55.805S133.23,219.805,133.23,189.034z M189.711,345.964
								c-3.269,3.269-7.554,4.904-11.837,4.904c-4.284,0-8.569-1.634-11.837-4.904c-6.538-6.538-6.538-17.138,0-23.676L322.29,166.035
								c6.537-6.538,17.138-6.538,23.676,0c6.538,6.538,6.538,17.138,0,23.676L189.711,345.964z M322.967,378.771
								c-30.771,0-55.805-25.034-55.805-55.805c0-30.771,25.034-55.805,55.805-55.805c30.771,0,55.805,25.034,55.805,55.805
								C378.772,353.737,353.738,378.771,322.967,378.771z"/>
					</svg>
					<div class="cart-content">
						<h2>Цены</h2>
						<p>Мы всегда радуем наших покупателей низкими ценами и постоянными скидками!</p>
					</div>
				</div>
				<div class="col-sm-4 col-md-4 advantages-cart">
					<svg class="cart-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 512.002 512.002" style="enable-background:new 0 0 512.002 512.002;" xml:space="preserve">
						<path d="M480.46,21.379c-1.598-4.062-3.926-7.692-6.92-10.785c-5.302-5.476-12.241-8.899-19.541-9.639
							c-63.177-6.382-132.301,19.483-184.893,69.205c-3.563,3.367-8.216,5.222-13.104,5.222c-4.888,0-9.541-1.855-13.102-5.22
							C190.304,20.44,121.191-5.426,58.005,0.957c-7.302,0.738-14.241,4.161-19.543,9.637c-2.995,3.093-5.324,6.723-6.92,10.786
							C4.183,90.987,13.957,176.714,57.688,250.702c41.041,69.434,107.008,118.24,175.95,131.489v28.375v10.159
							c0,38.901,23.057,74.047,58.742,89.538c2.719,1.181,5.55,1.74,8.337,1.74c8.098,0,15.812-4.72,19.244-12.623
							c4.611-10.621-0.263-22.97-10.884-27.58c-20.355-8.836-33.507-28.884-33.507-51.074v-9.685v-28.358
							c69.95-12.451,137.151-61.61,178.745-131.981C498.045,176.714,507.819,90.987,480.46,21.379z"/>
					</svg>
					<div class="cart-content">
						<h2>Свежесть</h2>
						<p>Мы бережно ухаживаем за цветами чтобы они приехали к вам свежими!</p>
					</div>
				</div>
			</div>
		</div>	

		<div class="recomended">
			<h1 class="text-center">Рекомендуемые товары</h1>

			<div class="row justify-content-center">
				<?php foreach($recomended_products as $product): ?>
					<div class="flower-cart col-md-4 col-sm-4">
						<div class="flower-preview">
							<img src="<?php echo $product["preview_image"]; ?>" alt="">
						</div>
						<div class="flower-cart-content">
							<h2 class="text-center"><?php echo $product["name"] ?></h2>
							<hr>
							<p><?php echo mb_substr($product["description"], 0, 139) . "..."; ?></p>
							<div class="price">
								<h5><?php echo $product["amount"] ?>руб.</h5>
							</div>
							<div class="shop-item">
								<a href="/flower?flower_id=<?php echo $product["id"]; ?>" title="Перейти к товару">
									<svg class="next-arrow" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 511.996 511.996" style="enable-background:new 0 0 511.996 511.996;" xml:space="preserve">
										<path d="M508.245,246.953L363.435,102.133c-5.001-5.001-13.099-5.001-18.099,0c-5.001,5-5.001,13.099,0,18.099l122.965,122.965
											H12.8c-7.074,0-12.8,5.726-12.8,12.8c0,7.074,5.726,12.8,12.8,12.8h455.492L345.327,391.763c-5.001,5-5.001,13.099,0,18.099
											c5.009,5.001,13.099,5.001,18.108,0l144.811-144.811C513.246,260.051,513.246,251.953,508.245,246.953z"/>
									</svg>
								</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>		
		
	</main>


	<?php include_once("footer.html") ?>
	

	
</body>
</html>