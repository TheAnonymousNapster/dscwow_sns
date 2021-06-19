<?php


if (isset($_POST['name']) && isset($_POST['phoneno']) && isset($_POST['email']) && isset($_POST['password'])) {
	include 'db_conn.php';

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$name = validate($_POST['name']);
	$phoneno = validate($_POST['phoneno']);
  $email = validate($_POST['email']);
  $password = validate($_POST['password']);

	if (empty($message) || empty($name) || empty($phoneno) || empty($password)) {
		header("Location: home.html");
	}else {

		$sql = "INSERT INTO details(name, phoneno, emailid, password) VALUES('$name', '$phoneno','$email','$password')";
		$res = mysqli_query($conn, $sql);

		if ($res) {
			echo "Your message was sent successfully!";
		}else {
			echo "Your message could not be sent!";
		}
	}

}else {
	header("Location: login-reg.html");
}
?>
