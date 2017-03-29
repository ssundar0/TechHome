<?php

require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$response = array("error" => false);

if(isset($_POST['order_type']) && isset($_POST['description']) && isset($_POST['slot']) && isset($_POST['city']) && isset($_POST['order_date']) && isset($_POST['mobile'])) {
	
	$order_type = $_POST['order_type'];
	$description = $_POST['description'];
	$slot = $_POST['slot'];
	$city = $_POST['city'];
	$order_date = $_POST['order_date'];
	$mobile = $_POST['mobile'];
	
		$order = $db->placeOrder($order_type, $description, $slot, $city, $order_date, $mobile);
		if($order) {
			$response["error"] = false;
			$response["orderid"] = $order["order_id"];
			$response["order"]["order_type"] = $user["order_type"];
			$response["order"]["description"] = $user["description"];
			$response["order"]["slot"] = $user["slot"];
			$response["order"]["city"] = $user["city"];
			$response["order"]["mobile"] = $user["mobile"];
			echo json_encode($response);
		} else {
			$response["error"] = true;
			$response["error_msg"] = "Unknown Error has Occurred..";
			echo json_encode($response);
		}
	
} else {
	$response["error"] = true;
	$response["error_msg"] = "Something's Missing..";
	echo json_encode($response);
	
}
?>