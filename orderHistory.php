<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$response = array("error" => false);

if(isset($_POST['mobile'])){
	$mobile = $_POST['mobile'];
	
	$order = $db->orderDetails($mobile);
	
	if($order != FALSE) {
		$response["error"] = false;
		$response["orders"] = array();
		$orders = array();
		$orders["order_id"] = $order["order_id"];
        $orders["order_type"] = $order["order_type"];
        $orders["description"] = $order["description"];
        $orders["city"] = $order["city"];
       
        array_push($response["orders"], $orders);
		echo json_encode($response);
		
	} else {
		$response["error_msg"] = "Some Error has occurred";
		echo json_encode($response);
	}
} else {
	$response["error_msg"] = "Some unexpected error has occurred";
	echo json_encode($response);
}
?>