<?php
$username = $_POST['name'];
$password = $_POST['password'];

$email = $_POST['email'];
$phoneno = $_POST['phoneno'];

if (!empty($username) || !empty($password) || !empty($phoneno) || !empty($email) ) {
    $host = "127.0.0.1:3307";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "sns";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT emailid From details Where emailid = ? Limit 1";
     $INSERT = "INSERT INTO details(name, phoneno, emailid, password)values(?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $stmt->store_result();
     $stmt->fetch();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssi", $username, $password,  $email, $phoneno);
      $stmt->execute();
      //echo "New record inserted sucessfully";
      header("Location: home.html");
    } else {
      header("Location: login-reg.html");
      //echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
