<?php 
	include("../db/db.php");
	$db = new MySQlither();

	function error_login($error_id){
		// 1 - Произошла ошибка
		// 2 - Такой пользователь не существует
		// 3 - Не правильный пароль
		header("Location: /?errorLogin=$error_id");
	}

	if(!isset($_POST['email'])){error_login(1);}else{$email = $_POST['email'];};
	if(!isset($_POST['password'])){error_login(1);}else{$password = $_POST['password'];};

	if (!$db->exists_user($email) == True){
		error_login(2);
		exit();
	}
	else{
		$user = $db->get_user_info($email);
		if ($password != $user["password"]){
			error_login(3);
			exit();
		}
		else{
			setcookie("email", $email, time()+3600*24, "/");
			header("Location: /");
		}
	}



?>