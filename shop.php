<?php 
	include("db/db.php");
	$db = new MySQlither();
	$categories = $db->get_categories();

	$args = [];
	$paginationArgs = "?";

	foreach ($_GET as $key => $arg){
		$args[$key] = $arg;
	}

	if (!array_key_exists("page", $args)){
		$args["page"] = 1;
	}

	foreach ($args as $key => $arg){
		if ($paginationArgs != "?"){
			$paginationArgs .= "&";
		}
		if ($key == "page"){
			$paginationArgs .= "$key=";
		}
		else{
			$paginationArgs .= "$key=$arg";
		}
	}

	$offset = ($args["page"]*10)-10; // Смешение товаров для пагинации
	
	if (array_key_exists("category", $args)){
		$products = $db->get_products_by_category($args["category"], $offset);
	}
	else{
		$products = $db->get_products($offset);
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Цветочек | Магазин</title>

	<link rel="icon" href="img/flower.ico">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">

	<script src="js/easy-toggler.min.js"></script>
</head>
<body class= "d-flex flex-column min-vh-100">

	<?php 
		include_once("header.php");
		include_once("modal_login.php");
	?>

	<main class="container omit-main">
		<div class="detail-menu d-flex justify-content-center">
			<div class="categories_">
				<div easy-toggle="#categories" easy-class="open" easy-rcoe easy-self="open" class="dropdown-btn d-flex">
					<h5 class="text-muted"><a href="#">Категории</a></h5>
					<svg class="b_arrow" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
					  <g id="_24x24_On_Light_Arrow-Bottom" data-name="24x24/On Light/Arrow-Bottom" transform="translate(0 24) rotate(-90)">
					    <rect id="view-box" width="24" height="24" fill="none"/>
					    <path id="Shape" d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z" transform="translate(14.75 17.75) rotate(180)" fill="#141124"/>
					  </g>
					</svg>
				</div>
				<div id="categories" class="dropdown-win shadow-lg">
					<div class="row">
						<?php foreach ($categories as $category):?>
							<?php
								$category = [
									$category["id"],
									$category["category_name"]
								]
							?>
							<div class="col nav-pills">
								<a class="text-center nav-link <?php if(array_key_exists("category", $args) && $args["category"] == $category[0]){echo "active";} ?>" href="<?php echo "?category=$category[0]" ?>"><?php echo $category[1] ?></a>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>		
		</div>

		<h1 class="text-center mt-2">Магазин</h1>

		<div class="catalog">
			<div class="row justify-content-center">
				<?php if(!$products): ?>
					<h2 class="text-center my-5">На этой странице ничего нет!</h2>
				<?php endif; ?>
				<?php foreach ($products as $product): ?>
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

		<nav aria-label="" class="d-flex justify-content-center mt-5">
		  <ul class="pagination">
		    <li class="page-item <?php if ($args["page"] == 1){echo "disabled";} ?>">
		      <a href="<?php echo $paginationArgs . ($args["page"]-1) ?>" class="page-link">
		      	<svg class="prev-arrow" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				  <g id="_24x24_On_Light_Arrow-Bottom" data-name="24x24/On Light/Arrow-Bottom" transform="translate(0 24) rotate(-90)">
				    <rect id="view-box" width="24" height="24" fill="none"/>
				    <path id="Shape" d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z" transform="translate(14.75 17.75) rotate(180)" fill="#141124"/>
				  </g>
				</svg>

		      </a>
		    </li>
		    <li class="page-item active">
		      <span class="page-link"><?php echo $args["page"]; ?>
		      </span>
		    </li>
		    <li class="page-item"><a class="page-link" href="<?php echo $paginationArgs . ($args["page"]+1) ?>"><?php echo $args["page"]+1; ?></a></li>
		    <li class="page-item"><a class="page-link" href="<?php echo $paginationArgs . ($args["page"]+2) ?>"><?php echo $args["page"]+2; ?></a></li>
		    <li class="page-item"><a class="page-link" href="<?php echo $paginationArgs . ($args["page"]+3) ?>"><?php echo $args["page"]+3; ?></a></li>

		    <li class="page-item">
		      <a class="page-link" href="<?php echo $paginationArgs . ($args["page"]+1) ?>">
		      	<svg class="next--arrow" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				  <g id="_24x24_On_Light_Arrow-Bottom" data-name="24x24/On Light/Arrow-Bottom" transform="translate(0 24) rotate(-90)">
				    <rect id="view-box" width="24" height="24" fill="none"/>
				    <path id="Shape" d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z" transform="translate(14.75 17.75) rotate(180)" fill="#141124"/>
				  </g>
				</svg>

		      </a>
		    </li>
		  </ul>
		</nav>

	</main>

	<?php include_once("footer.html") ?>
	
</body>
</html>