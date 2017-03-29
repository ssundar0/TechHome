<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$response = array();

if(isset($_POST['mobile'])){
	$mobile = $_POST['mobile'];
	
	$user = $db->userDetails($mobile);
	
	if($user != FALSE) {
		$response["user"]["name"] = $user["name"];
		$response["user"]["email"] = $user["email"];
		$response["user"]["mobile"] = $user["mobile"];
		$response["user"]["address"] = $user["address"];
		$response["user"]["city"] = $user["city"];
		$response["user"]["pincode"] = $user["pincode"];
		echo $response;
	} else {
		$response["error_msg"] = "Some Error has occurred";
		echo json_encode($response);
	}
} else {
	$response["error_msg"] = "Some unexpected error has occurred";
	echo json_encode($response);
}
?>