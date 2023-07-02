<?php 
	include("../db/db.php");
	$db = new MySQlither();

	function error_register($error_id){
		// 1 - Произошла ошибка
		// 2 - Такой пользователь уже существует
		// 3 - Пароли не совпадают
		header("Location: /?errorRegister=$error_id");
	}

	if (!isset($_POST['first_name'])){error_register(1);}else{$firstName = $_POST['first_name'];}
	if(!isset($_POST['last_name'])){error_register(1);}else{$lastName = $_POST['last_name'];};
	if(!isset($_POST['email'])){error_register(1);}else{$email = $_POST['email'];};
	if(!isset($_POST['password'])){error_register(1);}else{$password = $_POST['password'];};
	if(!isset($_POST['twoPassword'])){error_register(1);}else{$repeatPassword = $_POST['twoPassword'];};

	if ($db->exists_user($email) == True){
		error_register(2);
		exit();
	}
	else{
		if ($password != $repeatPassword){
			error_register(3);
			exit();
		}
		else{
			$db->add_client($firstName, $lastName, $email, $password);
			setcookie("email", $email, time()+3600*24, "/");
			header("Location: /");
		}
	}





?>