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
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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
        .late-entry {
            color: red; 
        }
        .table th, .table td {
            border: 2px solid black; 
        }

        .table tbody tr.late-entry:hover {

            color: red;
        }
        .fancybox-content {
            width: auto !important; 
            height: auto !important; 
        }
        .fancybox-image {
            max-width: 100%;
            max-height: 100%;
        }
        .tepat-waktu {
            color: green;
        }

        .terlambat {
            color: red;
        }
        .masuk { 
            color: green; 
        } 

        .izin { 
            color: blue; 
        } 

        .sakit { 
            color: orange; 
        }
        
        .keterangan-box {
            display: flex;
            padding: 2px 5px;
            border-radius: 3px;
            color: white;
        }
        
        .masuk .keterangan-box {
            background-color: green;
        }
        
        .izin .keterangan-box {
            background-color: blue;
        }
        
        .sakit .keterangan-box {
            background-color: orange;
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
        <header class="form-control">
            <h1>List Absen Masuk Guru</h1>
        </header>

        <div class="container">
            <div class="button-container">  <a href="datasiswa.php" class="btn btn-primary btn-md">Kembali</a>
                <a href="CETAK-M-GURU.php" class="btn btn-success">Cetak</a>
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

            <table class="table table-transparent table-hover table-bordered mt-5">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Id Guru</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Foto</th>
                        <th>Keterangan</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                                <tbody>
                <?php
            $i = 1;
            $bulan_dipilih = isset($_GET['bulan']) ? $_GET['bulan'] : '';
            $tahun_dipilih = isset($_GET['tahun']) ? $_GET['tahun'] : '';

            $sql = "SELECT tb_guru.*, master_jadwal.jam_masuk 
                        FROM tb_guru 
                        LEFT JOIN master_jadwal ON DAYNAME(tb_guru.tanggal_waktu) = master_jadwal.hari";

                $where_clause = "";

            if (!empty($bulan_dipilih)) {
                $where_clause .= "MONTH(tb_guru.tanggal_waktu) = '$bulan_dipilih'";
            }

            if (!empty($tahun_dipilih)) {
                if (!empty($where_clause)) {
                    $where_clause .= " AND ";
                }
                $where_clause .= "YEAR(tb_guru.tanggal_waktu) = '$tahun_dipilih'";
            }

            if (!empty($where_clause)) {
                $sql .= " WHERE " . $where_clause;
            }

            $query = mysqli_query($conn, $sql);

            if ($query) {
                while ($siswa = mysqli_fetch_array($query)) :
                    $status = 'tepat-waktu'; // Default status

                    if ($siswa['jam_masuk'] !== null) {
                        $jam_masuk = new DateTime($siswa['jam_masuk']);
                        $jam_absen = new DateTime($siswa['tanggal_waktu']);

                        $jam_masuk->setDate($jam_absen->format('Y'), $jam_absen->format('m'), $jam_absen->format('d'));


                        if ($jam_absen > $jam_masuk) {
                            $status = 'terlambat';
                        }
                    }

                    ?>
                             <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $siswa['id_guru'] ?></td>
                                <td><?php echo $siswa['nama'] ?></td>
                                <td><?php echo $siswa['tanggal_waktu'] ?></td>
                                <td class="<?php echo $status; ?>">
                            <?php echo ($status == 'terlambat') ? 'Terlambat' : 'Tepat Waktu'; ?>
                            </td>
                                <td>
                                    <a href="images/<?php echo $siswa['foto']; ?>" data-fancybox="gallery" data-caption="<?php echo $siswa['nama'] . ' - ' . $siswa['tanggal_waktu']; ?>">
                                        <img src="images/<?php echo $siswa['foto']; ?>" width="120" style="display: block;">
                                    </a>
                                </td>
                        
                            <td class="<?php echo $siswa['keterangan']; ?>"> 
                                <span class="keterangan-box">
                                    <?php echo $siswa['keterangan']; ?>
                                </span>
                            </td>
                        </td>
                        <td>
                            <div class='row'>
                                <div class='col d-flex justify-content-center'>
                                    <a href="EDIT-M-GURU.php?id=<?php echo $siswa['id'] ?>" class='btn btn-sm btn-warning'>
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                                <div class='col d-flex justify-content-center'>
                                    <a href="HAPUS-M-GURU.php?id=<?= $siswa['id']; ?>" onclick="return confirm('apakah anda yakin?');" class='btn btn-sm btn-danger'>
                                        <i class="bi bi-trash"></i>
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
            <p>Total Guru Absen:
                <?php echo mysqli_num_rows($query) ?>
            </p>
        </div>
    
</body>

</html>