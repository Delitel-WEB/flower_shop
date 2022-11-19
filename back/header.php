<?php 
	if(!isset($_COOKIE['email'])){$profile = NULL;}else{$profile =$_COOKIE['email'];}
?>
<header class="d-flex justify-content-center py-3 <?php if (!isset($main_page)){echo "scroll";}?>">
		
	<ul class="nav nav-pills justify-content-center">
		<li class="nav-item"><a href="/" class="nav-link <?php if (isset($main_page)){echo "active";} ?>" aria-current="page">Главная</a></li>
		<li class="nav-item"><a href="shop" class="nav-link <?php if (!isset($main_page)){echo "active";} ?>">Магазин</a></li>
	</ul>

	<?php if (!$profile): ?>
		<div class="login-btn">
			<button easy-toggle="#login-modal" easy-class="show" easy-rcoe type="button" class="btn btn-outline-primary me-2">Войти</button>
		</div>
	<?php else: ?>
		<div class="profile" easy-toggle="#profile" easy-class="show" easy-rcoe>
			<a href="#">
				<img src="img/profile.png" alt="">
			</a>
		</div>
	<?php endif; ?>

</header>