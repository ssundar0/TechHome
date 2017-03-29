<?php

require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$response = array("error" => false);

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['pincode']) && isset($_POST['password'])) {
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$pincode = $_POST['pincode'];
	$password = $_POST['password'];

	if($db->isUserExisted($mobile)) {
		$response["error"] = true;
		$response["error_msg"] = "User Already Exists!!";
		echo json_encode($response);
	} else {
		
		$user = $db->storeUser($name, $email, $mobile, $address, $city, $pincode, $password);
		if($user) {
			$response["error"] = false;
			$response["uid"] = $user["unique_id"];
			$response["user"]["name"] = $user["name"];
			$response["user"]["email"] = $user["email"];
			$response["user"]["mobile"] = $user["mobile"];
			$response["user"]["address"] = $user["address"];
			$response["user"]["city"] = $user["city"];
			$response["user"]["pincode"] = $user["pincode"];
			echo json_encode($response);
		} else {
			$response["error"] = true;
			$response["error_msg"] = "Unknown Error has Occurred..";
			echo json_encode($response);
		}
	}
} else {
	$response["error"] = true;
	$response["error_msg"] = "Something's Missing..";
	echo json_encode($response);
	
}
?>