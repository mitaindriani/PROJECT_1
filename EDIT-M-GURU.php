<?php include("conn.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include("conn.php"); date_default_timezone_set('Asia/Jakarta');

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data siswa berdasarkan ID
$sql = "SELECT * FROM tb_guru WHERE id = $id";
$query = mysqli_query($conn, $sql);
$siswa = mysqli_fetch_array($query);

if (!$siswa) {
    die("Data tidak ditemukan!");
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
      margin: 0;
      padding: 0;
      display: flex;
    }

    nav li {
      margin-left: 20px;
    }

    nav a {
      color: white;
      text-decoration: none;
      padding: 5px 10px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
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

    .content {
      padding: 20px;
      margin-top: 0px;
      font-family: sans-serif;
      background-color: #cadef5;
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex; 
      justify-content: center; 
      align-items: center; 
    }
    .header-title {
      text-align: center; 
      margin-top: 20px; 
    }

    .card {
      background-color: rgba(255, 255, 255, 0.8); 
      border: none; 
      border-radius: 15px; 
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); 
      margin-top: 40px;
    }

    .form-control {
      border-radius: 10px; 
    }

    .btn {
      border-radius: 10px; 
    }

    .row {
      display: flex;
      justify-content: space-between; 
      align-items: center; 
    }

    .col-md-6 {
      flex: 1;
      margin-right: 15px;
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
    <div class="card w-50 mx-auto p-4">
    <header  class="header-title">
        <h1>Edit Absen Masuk</h1><br>
        </header>
    <form action="PRO-EDIT-MASUK.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $siswa['id']; ?>">
    <div class="row mb-3">
      <div class="col-md-6">
        <ol for="id_guru">Id Guru</ol>
        <input type="text" class="form-control" id="id_guru" name="id_guru" value="<?php echo $siswa['id_guru']; ?>" required>
      </div>
      <div class="col-md-6">
        <ol for="nama">Nama</ol>
        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $siswa['nama']; ?>" required>
      </div>
  </div>
  <div class="row mb-3">
      <div class="col-md-6">
        <ol for="keterangan">Keterangan</ol>
        <select class="form-select" id="keterangan" name="keterangan" required>
            <option value="masuk" <?php echo ($siswa['keterangan'] == 'masuk') ? 'selected' : ''; ?>>Masuk</option>
            <option value="izin" <?php echo ($siswa['keterangan'] == 'izin') ? 'selected' : ''; ?>>Izin</option>
            <option value="sakit" <?php echo ($siswa['keterangan'] == 'sakit') ? 'selected' : ''; ?>>Sakit</option>
        </select>
      </div>
      <div class="col-md-6">
        <ol for="tanggal_waktu">Tanggal</ol>
        <input type="datetime-local" class="form-control" id="tanggal_waktu" name="tanggal_waktu" value="<?php echo $siswa['tanggal_waktu']; ?>" readonly>
      </div>
  </div>
      <div class="mb-3">
        <ol for="foto">Foto Guru:</ol>
        <input type="file" name="foto" class="form-control" onchange="previewImage()">
        <img src="images/<?= $siswa['foto']; ?>" width="120" style="display: block;" class="img-preview">
      </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="LIST-M-GURU.php" class="btn btn-secondary">Kembali</a>
</form>
</div>
</body>
<style>
.container .sidenav {
    width: 115px;
    height: 100vh;
    overflow: hidden;
    position: fixed;
    padding: 40px 16px;
    background-color: #000;
    transition: width 0.6s, left 0.6s;
    left: -20px;
    bottom: 0px;
}
</style>

</html>