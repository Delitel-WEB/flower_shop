<?php 
	include("db/db.php");
	$db = new MySQlither();

	if(!isset($_GET["flower_id"])){
		header("Location: /page_not_found.html");
	}
	else{
		if (!is_numeric($_GET["flower_id"])){
			header("Location: /page_not_found.html");
		}
		else{
			$product = $db->get_product_by_id($_GET["flower_id"]);
			if (!$product){
				header("Location: /page_not_found.html");
			}
			else{
				$productId = $product["id"];
				$productTitle = $product["name"];
				$productAmount = $product["amount"];
				$productCategoryId = $product["category_id"];
				$productCategory = $db->get_category($productCategoryId)["category_name"];
				$productPreview = $product["preview_image"];
				$productDescription = $product["description"];
				$productCount = $product["count"];

				$similarProducts = $db->get_products_by_category($productCategoryId, 0);

			}
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Цветочек | <?php echo $productTitle; ?></title>

	<link rel="icon" href="img/flower.ico">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">

	<script src="js/easy-toggler.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
	
	<?php 
		include_once("header.php");
		include_once("modal_login.php");
	?>

	<?php if($profile and $productCount > 0): ?>
		<div id="buy_window" class="modal-win">
			<div class="modal-window shadow-lg">
				<h1>Ещё одну минуточку!</h1>
				<hr>
				<p>Для отправки товара нам необходимо знать ваш адрес!</p>
				<button easy-toggle="#buy_window" easy-remove="show" class="close-btn">X</button>
				<form action="login_actions/buy_product.php" method="post">					
					<div class="row justify-content-center">
						<div class="col-3">
							<h6 class='text-muted'>Номер товара: </h6>
							<input disabled="disabled" value="<?php echo $productId;?>" type="text" class="form-control text-muted">
						</div>
						<div class="col-5">
							<h6 class='text-muted'>Название товара: </h6>
							<input name="product_name" disabled="disabled" value="<?php echo $productTitle;?>" type="text" class="form-control text-muted">
						</div>
						<div class="col-8">
							<h6 class='text-muted'>Адрес: </h6>
							<input name="adress" required type="text" class="form-control" placeholder="г. Москва Ул. Пушкина Дом Колотушкина 42">
						</div>

						<input name="product_id" value="<?php echo $productId;?>" type="text" class="hidden_input">
						<input name="client_id" value="<?php echo $userInfo["id"];?>" type="text" class="hidden_input">
					</div>
					<button type="submit" class="btn btn-primary mb-2">Купить</button>
				</form>
			</div>

			<div class="overlay" easy-toggle="#buy_window" easy-remove="show"></div>
		</div>
	<?php endif; ?>

	<main class="omit-main container">
		<div class="flower-window">
			<div class="flower-inner">
				<div class="flower-descriptions d-flex">
					<div class="flower-preview-small">
					<img src="<?php echo $productPreview; ?>" alt="">
					</div>
					<div class="titles">
						<h1><?php echo $productTitle; ?></h1>
						<p class="description">
							<?php echo $productDescription; ?>
						</p>
						<h3 class="price"><?php echo $productAmount; ?> р.</h3>
					</div>
				</div>
				<div class="additionally mt-3">
					<h5>Количество: <b><?php echo $productCount; ?></b></h5>
					<a <?php if ($profile and $productCount > 0){echo 'easy-toggle="#buy_window" easy-class="show" easy-rcoe';} ?> href="#" class="btn btn-outline-primary <?php if(!$profile or $productCount <= 0){echo "disabled";}?>">Купить</a>
				</div>
			</div>
			<div class="category d-flex">
				<h5 class="mx-2 text-muted">Категория: </h5>
				<h5 class="category-name text-muted"><a href="/shop?category=<?php echo $productCategoryId; ?>"><?php echo $productCategory; ?></a></h5>
			</div>
		</div>

		<div class="similar mt-5">
			<h4 class="text-muted">Похожие товары</h4>
			<div class="catalog">
				<div class="row justify-content-center">
					<?php foreach($similarProducts as $prod): ?>
						<?php if ($prod[0] != $productId): ?>
							<div class="flower-cart col-md-4 col-sm-4">
								<div class="flower-preview">
									<img src="<?php echo $prod[4]; ?>" alt="">
								</div>
								<div class="flower-cart-content">
									<h2 class="text-center"><?php echo $prod[1]; ?></h2>
									<hr>
									<p><?php echo mb_substr($prod[5], 0, 139) . "..."; ?></p>
									<div class="price">
										<h5><?php echo $prod[2] ?>руб.</h5>
									</div>
									<div class="shop-item">
										<a href="/flower?flower_id=<?php echo $prod[0]; ?>" title="Перейти к товару">
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
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</main>

	<?php include_once("footer.html") ?>

	
</body>
</html>