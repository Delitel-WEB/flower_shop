<?php 

	function error_redirect(){
		header("Location: /");
	}

	if (!isset($_POST['product_id'])){error_redirect();}else{$productID = $_POST['product_id'];};
	if (!isset($_POST['client_id'])){error_redirect();}else{$clientID = $_POST['client_id'];};
	if (!isset($_POST['adress'])){error_redirect();}else{$adress = $_POST['adress'];};


	include("../db/db.php");
	$db = new MySQlither();

	$product_info = $db->get_product_by_id($productID);
	$db->add_purchases($clientID, $productID, $adress, $product_info["amount"]);
	$db->subtract_product_item($productID);

	header("Location: /flower?flower_id=$productID")

?>