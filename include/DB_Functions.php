<?php
class DB_Functions{
	private $conn;
	function __construct(){
		require_once 'DB_Connect.php';
		$db = new DB_Connect();
		$this->conn = $db->connect();
	}
	
	function destruct(){

	}

	public function storeUser($name, $email, $mobile, $address, $city, $pincode, $password){
		
		$uuid = uniqid('', true);
		$query = "INSERT INTO users(unique_id, name, email, mobile, address, city, pincode, password) VALUES('$uuid', '$name', '$email', '$mobile', '$address', '$city', '$pincode', '$password')";
                $result = mysqli_query($this->conn, $query);
		
                if($result){
                      $quer = "SELECT * FROM users WHERE mobile = '$mobile'";
                      $user = mysqli_query($this->conn, $quer);
                      $user = mysqli_fetch_array($user);
                      return $user;
                }
	}

	public function getUserByMobileAndPassword($mobile, $password) {
                $query = "SELECT * FROM users WHERE mobile = '$mobile'";
                $user = mysqli_query($this->conn, $query);
                $no_of_rows = $user->num_rows;

                if ($no_of_rows > 0) {

                       $user = mysqli_fetch_array($user);
                       $pass = $user['password'];
                       if($password == $pass){
                             return $user;

                       } else {
                            return NULL;
                       }
                }
	}

	public function isUserExisted($mobile) {
		
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE mobile = ?");
		$stmt->bind_param("s", $mobile);
		$stmt->execute();
		$stmt->store_result();
		
		if($stmt->num_rows > 0) {
			
			$stmt->close();
			return true;
		}else {
			$stmt->close();
			return false;
		}
	}
	
	public function userDetails($mobile){
		
		$query = "SELECT * FROM users WHERE mobile = '$mobile'";
		  
		  $user = mysqli_query($this->conn, $query);
          $user = mysqli_fetch_array($user);
          
		  return $user;
		
	}
	
	public function placeOrder($order_type, $description, $slot, $city, $order_date, $mobile){
		
		$orderid = uniqid('', true);
		$query = "INSERT INTO orders(order_id, order_type, description, slot, city, order_date, mobile) VALUES('$orderid', '$order_type', '$description', '$slot', '$city', '$order_date', '$mobile')";
                $result = mysqli_query($this->conn, $query);
		
                if($result){
                      $quer = "SELECT * FROM orders WHERE mobile = '$mobile'";
                      $order = mysqli_query($this->conn, $quer);
                      $order = mysqli_fetch_array($order);
                      return $order;
                }
	}
	
	public function orderDetails($mobile){
		
		$query = "SELECT * FROM orders WHERE mobile = '$mobile'";
		  
		  $order = mysqli_query($this->conn, $query);
          $order = mysqli_fetch_array($order)
		
		  return $return; 
	}
			
}
	
?>