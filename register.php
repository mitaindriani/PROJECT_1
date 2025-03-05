<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "db_apk2"; 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $mode = $_POST["mode"];

  if ($mode === "register") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "INSERT INTO tb_login (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) { 
      header("Location: login.php");
      exit();
    } else {
      echo "<script>alert('Gagal melakukan registrasi.');</script>";
    }
  }
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<style>
body {
  font-family: sans-serif;
  background-image: url('blue.jpeg'); 
  background-size: cover;
  background-position: center;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  position: relative;
  overflow: hidden; 
}

body::before {
  content: ""; 
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(255, 255, 255, 0.2); 
  z-index: 1; 
}

.container {
  background-color: transparent;
  padding: 40px 100px;
  border-radius: 10px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.9);
  position: relative;
  z-index: 2; 
}

.logo {
  width: 200px;
  height: 180px;
  margin-bottom: 20px;
}

.title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

.input {
  width: 100%;
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 15px;
  border-radius: 5px;
}

.button {
  background-color: #001A6E;
  color: #fff;
  padding: 12px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.toggle-text {
  margin-top: 20px;
  color: #001A6E;
}
</style>
</head>
<body>

<div class="container">
  <img src="logo.png" alt="Logo" class="logo"> 
  <h2 class="title">Register</h2> 

  <form method="post" action="">
    <input type="hidden" name="mode" value="register"> 
    <input type="text" name="username" class="input" placeholder="Username" required><br>
    <input type="password" name="password" class="input" placeholder="Password" required><br>
    <button type="submit" class="button">Register</button>
  </form>

  <p class="toggle-text">Sudah punya akun? <a href="login.php">Login</a></p>
</div>

</body>
</html>
