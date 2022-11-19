<?php

class MySQlither{
	public $db;

	function __construct(){
		$this->db = new mysqli("localhost", "root", "", "flower_shop");
		mysqli_set_charset($this->db, 'utf8');
	}

	function get_products($offset=-1){
		if ($offset == -1){
			$result = $this->db->query("SELECT * FROM	`products`");
		}
		else{
			$result = $this->db->query("SELECT * FROM	`products` LIMIT $offset, 10");
		}

		return $result->fetch_all();
	}

	function get_products_by_category($category, $offset=-1){
		if ($offset == -1){
			$result = $this->db->query("SELECT * FROM `products` WHERE `category_id`=$category");
		}
		else{
			$result = $this->db->query("SELECT * FROM `products` WHERE `category_id`=$category LIMIT $offset, 10");
		}
		return $result->fetch_all();
	}

	function get_product_by_id($flower_id){
		return $this->db->query("SELECT * FROM `products` WHERE `id`=$flower_id")->fetch_assoc();
	}

	function get_categories(){
		return $this->db->query("SELECT * FROM	`categories`")->fetch_all();
	}

	function get_category($category_id){
		return $this->db->query("SELECT * FROM `categories` WHERE `id`=$category_id")->fetch_assoc();
	}

	function exists_user($email){
		return $this->db->query("SELECT * FROM `client` WHERE `email`='$email'")->fetch_assoc();
	}

	function get_user_info($email){
		return $this->db->query("SELECT * FROM `client` WHERE `email`='$email'")->fetch_assoc();
	}

	function add_client($firstName, $lastName, $email, $password){
		$this->db->query("INSERT INTO `client` (`first_name`, `last_name`, `email`, `password`) VALUES('$firstName', '$lastName', '$email', '$password')");
	}

	function add_purchases($client_id, $product_id, $adress, $purchase_amount, $status=0){
		$this->db->query("INSERT INTO `purchases` (`client_id`, `product_id`, `adress`, `purchase_amount`, `status`) VALUES($client_id, $product_id, '$adress', $purchase_amount, $status)");
	}
	
	function subtract_product_item($product_id){
		$before_item = $this->get_product_by_id($product_id);

		$after_count= $before_item["count"]-1;
		$this->db->query("UPDATE `products` SET `count`=$after_count WHERE `id`=$product_id");
	}

	function get_last_10_purchases(){
		$purchases_ids = $this->db->query("SELECT (`product_id`) FROM `purchases` ORDER BY `id` DESC LIMIT 0, 10")->fetch_all();

		$products = [];
		foreach($purchases_ids as $product){
			$r = $this->get_product_by_id($product[0]);
			if(!in_array($r, $products)){
				array_push($products, $r);
			}
		}
		return $products;
	}

}