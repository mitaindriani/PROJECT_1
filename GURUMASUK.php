<?php include("conn.php"); 
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}
date_default_timezone_set('Asia/Jakarta');?>
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
      top: 0px;
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
      <li><a href="contact.php"><i class='bx bxs-cog'></i> Contact</a></li>
      <li><a href="logout.php"><i class='bx bx-log-in'></i> Logout</a></li>
    </ul>
  </nav>

    <div class="content">
     <div class="card w-50 mx-auto p-4">
      <header class="header-title">
        <h1>Absen Masuk Guru</h1>
      </header>
        <form action="PROSES_GURU.php" method="POST" enctype="multipart/form-data">
          <fieldset>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <ol for="id_guru">ID Guru:</ol>
                    <input type="text" name="id_guru" placeholder="ID Guru" class="form-control" required />
                  </div>
                  <div class="col-md-6">
                    <ol for="nama">Nama:</ol>
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control" required />
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                      <label for="tanggal_waktu">Tanggal dan Waktu:</label>
                      <input type="datetime-local" name="tanggal_waktu" class="form-control" value="<?php echo date('Y-m-d\TH:i:s'); ?>" readonly/>
                  </div>
                  <div class="col-md-6">
                    <label for="foto">Foto Guru:</label>
                    <input type="file" class="form-control" id="foto" name="foto" required>
                  </div>
                </div>
              <div class="mb-3">
                <label for="keterangan">Keterangan:</label>
                <select name="keterangan" id="keterangan" class="form-select" required>
                <option value="">Pilih Keterangan</option>   
                <option value="masuk">Masuk</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
              </select>
            </div>
            <button type="submit" name="daftar" class="btn btn-primary">Absen</button>
                  <a href="absenmasuk.php" class="btn btn-secondary">Kembali</a>
          </div>
        </fieldset>
      </form>
  </div>
</body>
</html>