<?php include("conn.php"); 
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
      padding: 100px;
      border-radius: 60px; 
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); 
      text-align: center; 
      width: 80%;
      max-width: 800px; 
      height: 300px;
    }

    .subject_buttons button {
      margin: 10px; 
      background-color:rgb(115, 144, 173); 
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
      margin-top: 70px;
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

    .button-container {
            display: flex; 
            justify-content: flex-end;
            margin-top: 80px;
            margin-bottom: -40px;
        }

        .button-container .btn {
            margin-left: 10px;
        }

        .form-control {
            border: none;
            background-color: transparent;
            padding: 0;
            margin-top: 100px; 
            margin-bottom: 20px;
            text-align: center; 
        }

        .form-control h1 {
            margin-bottom: -40px;
        }
        body{
            background-color:#D9EAFD;
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
        <header class="form-control">
            <h1>List Absen Pulang Siswa</h1>
        </header>

        <div class="container">
            <div class="button-container">  <a href="datasiswa.php" class="btn btn-primary btn-md">Kembali</a>
                <a href="cetakpulang.php" class="btn btn-success">Cetak</a>
            </div>

            <form method="GET" action="">
                <div class="row mb-3">
                    <div class="col-auto">
                        <select class="form-select" name="bulan">
                            <option value="">-- Pilih Bulan --</option>
                            <?php
                            $bulan = array(
                                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                            );
                            for ($i = 1; $i <= 12; $i++) {
                                $selected = (isset($_GET['bulan']) && $_GET['bulan'] == $i) ? 'selected' : '';
                                echo '<option value="' . $i . '" ' . $selected . '>' . $bulan[$i - 1] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" name="tahun">
                            <option value="">-- Pilih Tahun --</option>
                            <?php
                            $tahun_awal = 2020; // Ganti dengan tahun awal yang di inginkan
                            $tahun_akhir = date("Y");
                            for ($tahun = $tahun_awal; $tahun <= $tahun_akhir; $tahun++) {
                                $selected_tahun = (isset($_GET['tahun']) && $_GET['tahun'] == $tahun) ? 'selected' : '';
                                echo "<option value='$tahun' $selected_tahun>$tahun</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                </div>
            </form>

            <table class="table table-striped table-hover table-bordered mt-5">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Tanggal & waktu</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $bulan_dipilih = isset($_GET['bulan']) ? $_GET['bulan'] : '';
                    $tahun_dipilih = isset($_GET['tahun']) ? $_GET['tahun'] : '';

                    $sql = "SELECT * FROM tb_pulang";
                    $where_clause = "";

                    if (!empty($bulan_dipilih)) {
                        $where_clause .= "MONTH(tanggal_waktu) = '$bulan_dipilih'";
                    }

                    if (!empty($tahun_dipilih)) {
                        if (!empty($where_clause)) {
                            $where_clause .= " AND ";
                        }
                        $where_clause .= "YEAR(tanggal_waktu) = '$tahun_dipilih'";
                    }

                    if (!empty($where_clause)) {
                        $sql .= " WHERE " . $where_clause;
                    }

                    $query = mysqli_query($conn, $sql);

                    if ($query) {
                        while ($siswa = mysqli_fetch_array($query)):
                            ?>
                            <tr>
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td>
                                    <?php echo $siswa['nama'] ?>
                                </td>
                                <td>
                                    <?php echo $siswa['kelas'] ?>
                                </td>
                                <td>
                                    <?php echo $siswa['jurusan'] ?>
                                </td>
                                <td>
                                    <?php echo $siswa['tanggal_waktu'] ?>
                                </td>
                                <td>
                                <div class='row'>
                                    <div class='col d-flex justify-content-center'>
                                        <a href="form-edit-pulang.php?id=<?php echo $siswa['id'] ?>" class='btn btn-sm btn-warning'>
                                            <i class='bx bxs-edit'></i>
                                        </a>
                                    </div>
                                    <div class='col d-flex justify-content-center'>
                                        <a href="hapuspulang.php?id=<?= $siswa['id']; ?>" onclick="return confirm('apakah anda yakin?');" class='btn btn-sm btn-danger'>
                                            <i class='bx bxs-trash'></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            </tr>
                            <?php $i++;
                        endwhile;
                    } else {
                        echo "<tr><td colspan='9'>Error: " . mysqli_error($conn) . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <p>Total Siswa Absen Pulang: 
                <?php echo mysqli_num_rows($query) ?>
            </p>
        </div>
    </div>
    
</body>

</html>