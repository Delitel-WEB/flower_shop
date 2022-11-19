<?php 
	
	setcookie("email", $_COOKIE['email'], time(), "/");
	header("Location: /");

?>