<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['username']) && isset($_POST['password']))
 {

	$uname = $_POST['username'];
	$pass = $_POST['password'];

	if (empty($uname)) {
		header("Location: login1.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: login1.php?error=Password is required");
	    exit();
	}else{

		$stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
		$stmt->execute([$uname]);

		if ($stmt->rowCount() === 1) {
			$user = $stmt->fetch();

			$user_id = $user['id'];
			$user_name = $user['username'];
			$user_password = $user['password'];
			$user_full_name = $user['name'];
			
			// echo $pass;
			if ($uname === $user_name) 
			{

				if (password_verify($pass,$user_password)) {
					
					// echo 'Login';
					$_SESSION['user_id'] = $user_id;
					$_SESSION['user_name'] = $user_name;
					$_SESSION['user_full_name'] = $user_full_name;
					header("Location: home.php");

				}else {
					header("Location: login1.php?error=Incorect User 6969name or password&username=$uname");
				}
			}
			else 
			{
				header("Location: login1.php?error=Incorect User name or password&username=$uname");
			}
		}else {
			header("Location: login1.php?error=Incorect User name or password&username=$uname");
		}
	}
	
}else{
	header("Location: login1.php");
	exit();
}