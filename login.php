<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$response = array("error" => FALSE);

if(isset($_POST['mobile']) && isset($_POST['password'])) {
	$mobile = $_POST['mobile'];
	$password = $_POST['password'];

	$user = $db->getUserByMobileAndPassword($mobile, $password);
	
	if($user != FALSE) {
		$response["error"] = FALSE;
		$response["uid"] = $user["unique_id"];
		$response["user"]["name"] = $user["name"];
		$response["user"]["mobile"] = $user["mobile"];
		echo json_encode($response);
	} else {
		$response["error"] = TRUE;
		$response["error_msg"] = "Incorrect Mobile or Password...";
		echo json_encode($response);
	}
} else {
	$response["error"] = TRUE;
	$response["error_msg"] = "No Blanks should be left empty..";
	echo json_encode($response);
}
?>