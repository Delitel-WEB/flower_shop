<?php 
	if (!isset($_GET["errorRegister"])){$errorRegister = NULL;}else{$errorRegister=$_GET["errorRegister"];}
	if (!isset($_GET["errorLogin"])){$errorLogin = NULL;}else{$errorLogin=$_GET["errorLogin"];}

	if(!isset($_COOKIE['email'])){$profile = NULL;}else{$profile =$_COOKIE['email'];}

	if ($profile){
		if (!isset($db)){
			include("db/db.php");
			$db = new MySQlither();
		}
		

		$userInfo = $db->get_user_info($profile);
		if (!$userInfo){
			$userInfo = [
				"first_name" => "Не найден пользователь!",
				"last_name" => "Не найден пользователь!",
				"email" => "Не найден пользователь!"
			];
		}
	}
?>

<?php if (!$profile): ?>
	<div id="register-modal" class="modal-win <?php if ($errorRegister){echo "show";} ?>">
		<div class="modal-window shadow-lg">
			<h1>Регистрация</h1>
			<?php if ($errorRegister == 1): ?>
				<p class="text-center" style="color:red;">Произошла неизвестная ошибка</p>
			<?php elseif ($errorRegister == 2): ?>
				<p class="text-center" style="color:red;">Такой пользователь уже существует!</p>
			<?php elseif ($errorRegister == 3): ?>
				<p class="text-center" style="color:red;">Пароли не совпадают!</p>
			<?php endif; ?>
			<hr>
			<button easy-toggle="#register-modal" easy-remove="show" class="close-btn">X</button>
			<form action="login_actions/register.php" method="post">
				<div class="row justify-content-center">
					<div class="col-5">
						<input name="first_name" required type="text" class="form-control" placeholder="Имя">
					</div>
					<div class="col-5">
						<input name="last_name" required type="text" class="form-control" placeholder="Фамилия">
					</div>
					<div class="col-5">
						<input name="email" required type="text" class="form-control" placeholder="Почта">
					</div>
					<div class="col-8">
						<input name="password" required type="password" class="form-control" id="inputPassword" placeholder="Пароль">
					</div>
					<div class="col-8">
						<input name="twoPassword" required type="password" class="form-control" id="inputPassword" placeholder="Подтвердите пароль">
					</div>
				</div>
				<button type="submit" class="btn btn-primary mb-2">Зарегистрироваться</button>
			</form>

		</div>
		<div class="overlay" easy-toggle="#register-modal" easy-remove="show"></div>
	</div>

	<div id="login-modal" class="modal-win <?php if ($errorLogin){echo "show";} ?>">
		<div class="modal-window shadow-lg">
			<h1>Вход</h1>
			<?php if ($errorLogin == 1): ?>
				<p class="text-center" style="color:red;">Произошла неизвестная ошибка</p>
			<?php elseif ($errorLogin == 2): ?>
				<p class="text-center" style="color:red;">Такой пользователь не существует!</p>
			<?php elseif ($errorLogin == 3): ?>
				<p class="text-center" style="color:red;">Неправильный пароль!</p>
			<?php endif; ?>
			<hr>
			<button easy-toggle="#login-modal" easy-remove="show" class="close-btn">X</button>
			<form action="login_actions/login.php" method="post">
				<div class="row justify-content-center">
					<div class="col-8">
						<input name="email" required type="text" class="form-control" placeholder="Почта">
					</div>
					<div class="col-8">
						<input name="password" required type="password" class="form-control" id="inputPassword" placeholder="Пароль">
					</div>
				</div>
				<button type="submit" class="btn btn-primary mb-2">Войти</button>
				<a class="register" href="#" easy-toggle="#register-modal" easy-class="show" easy-rcoe>Ещё нет аккаунта?</a>
			</form>
		</div>

		<div class="overlay" easy-toggle="#login-modal" easy-remove="show"></div>
	</div>
<?php else: ?>
	<div id="profile" class="modal-win">
		<div class="modal-window shadow-lg">
			<h1>Профиль</h1>
			<hr>
			<button easy-toggle="#profile" easy-remove="show" class="close-btn">X</button>
			<div class="row justify-content-center text-center">
				<div class="col-5">
					<h6>Ваше имя: <?php echo $userInfo["first_name"] ?></h6>
				</div>
				<div class="col-5">
					<h6>Ваша Фамилия: <?php echo $userInfo["last_name"] ?></h6>
				</div>
				<div class="col-5">
					<h6 >Ваш email: <?php echo $userInfo["email"] ?></h6>
				</div>
			</div>
			<form action="login_actions/relogin.php">
				<button type="submit" class="btn btn-primary mb-2">Выйти</button>	
			</form>

		</div>

		<div class="overlay" easy-toggle="#profile" easy-remove="show"></div>
	</div>
<?php endif; ?>