<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


class MYSQLither{
	public $db;

	function __construct(){
		$this->db = pg_connect("host=localhost dbname=flower_shop user=delitel password=");
	}

	function get_products($offset=-1){
		if ($offset == -1){
			$result = pg_query($this->db, "SELECT * FROM products");
		}
		else{
			$result = pg_query($this->db, "SELECT * FROM products OFFSET $offset LIMIT 10");
		}

		return pg_fetch_all($result);
	}

	function get_products_by_category($category, $offset=-1){
		if ($offset == -1){
			$result = pg_query($this->db, "SELECT * FROM products WHERE category_id=$category");
		}
		else{
			$result = pg_query($this->db, "SELECT * FROM products WHERE category_id=$category OFFSET $offset LIMIT 10");
		}
		return pg_fetch_all($result);
	}

	function get_product_by_id($flower_id){
		$result = pg_query($this->db, "SELECT * FROM products WHERE id=$flower_id");
		return pg_fetch_assoc($result);
	}

	function get_categories(){
		$result = pg_query($this->db, "SELECT * FROM categories");
		return pg_fetch_all($result);
	}

	function get_category($category_id){
		$result = pg_query($this->db, "SELECT * FROM categories WHERE id=$category_id");
		return pg_fetch_assoc($result);
	}

	function exists_user($email){
		$result = pg_query($this->db, "SELECT * FROM client WHERE email='$email'");
		return pg_fetch_assoc($result);
	}

	function get_user_info($email){
		$result = pg_query($this->db, "SELECT * FROM client WHERE email='$email'");
		return pg_fetch_assoc($result);
	}

	function add_client($firstName, $lastName, $email, $password){
		pg_query($this->db, "INSERT INTO client (first_name, last_name, email, password) VALUES('$firstName', '$lastName', '$email', '$password')");
	}

	function add_purchases($client_id, $product_id, $address, $purchase_amount, $status=0){
		print($client_id);
		print($product_id);
		print($address);
		print($purchase_amount);
		print($status);

		pg_query($this->db, "INSERT INTO purchases (client_id, product_id, adress, purchase_amount, status) VALUES($client_id, $product_id, '$address', $purchase_amount, $status)");
	}
	
	function subtract_product_item($product_id){
		$before_item = $this->get_product_by_id($product_id);

		$after_count= $before_item["count"]-1;
		pg_query($this->db, "UPDATE products SET count=$after_count WHERE id=$product_id");
	}

	function get_last_10_purchases(){
		$purchases_ids = pg_query($this->db, "SELECT product_id FROM purchases ORDER BY id DESC LIMIT 10");
		$purchases_ids = pg_fetch_all($purchases_ids);

		$products = [];
		foreach($purchases_ids as $product){
			$r = $this->get_product_by_id($product['product_id']);
			if(!in_array($r, $products)){
				array_push($products, $r);
			}
		}
		return $products;
	}

}
