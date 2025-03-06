<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Example</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    nav {
      background-color: #333;
      color: white;
      padding: 20px;
      top:0px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      width: 100%;
      z-index: 100;
    }

    nav ul {
      list-style: none;
      margin: 10px;
      padding: 2px;
      display: flex;
    }

    nav li {
      margin-left: 20px;
      font-size: large;
    }

    nav a {
      color: white;
      text-decoration: none;
      padding: 5px 10px;
      border-radius: 5px;
      transition: background-color 0.5s ease;
    }

    nav a:hover {
      background-color: #555;
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo img {
      margin-right: 10px;
    }

    .absen-box {
      background-color: white;
      padding: 60px;
      border-radius: 20px; 
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 100%; 
      max-width: 500px; 
      height: 240px;
    }

    .subject_buttons button {
      margin: 10px;
      background-color: rgb(115, 144, 173);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 30px;
      transition: background-color 0.3s ease;
    }

    .subject_buttons button:hover {
      background-color: #0056b3;
    }

    .content {
      padding: 100px 20px;
      margin-top: 0px;
      font-family: sans-serif;
      background-color: #cadef5;
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      overflow-y: auto;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>

<body>
  <nav>
    <div class="logo">
      <img src="kanesa.png" width="50px" height="50px">
      <h2>SMKN 1 KEPANJEN</h2>
    </div>
    <ul>
      <li><a href="index.php"><i class='bx bxs-home'></i> Home</a></li>
      <li><a href="absenmasuk.php"><i class='bx bxs-user-circle'></i> Absen Masuk</a></li>
      <li><a href="absenpulang.php"><i class='bx bxs-message-dots'></i> Absen Pulang</a></li>
      <li><a href="datasiswa.php"><i class='bx bxs-bar-chart-alt-2'></i> Data Absensi</a></li>
      <li><a href="setting_jam_kerja.php"><i class='bx bx-log-in'></i>Master Jadwal</a></li>
      <li><a href="contact.php"><i class='bx bxs-cog'></i> Contact</a></li>
      <li><a href="logout.php"><i class='bx bx-log-in'></i> Logout</a></li>
    </ul>
  </nav>

  <div class="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="absen-box">
            <h1>Data Absen Siswa</h1>
            <div class="subject_buttons">
              <button onclick="location.href='listmasuk.php'">Absen Masuk</button>
              <button onclick="location.href='listpulang.php'">Absen Pulang</button>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="absen-box">
            <h1>Data Absen Guru</h1>
            <div class="subject_buttons">
              <button onclick="location.href='LIST-M-GURU.php'">Absen Masuk</button>
              <button onclick="location.href='LIST-P-GURU.php'">Absen Pulang</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>