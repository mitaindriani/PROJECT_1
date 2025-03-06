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
    <title>WEBSISWA - List Pendaftar Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        @media print {
            body {
                margin: 0; 
                font-size: 12pt; 
            }

            .container {
                max-width: 100%; 
                padding: 0; 
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid black; 
                padding: 8px; 
                text-align: left; 
            }

            img {
                max-width: 80px; 
                height: auto;
            }

            .no-print {
                display: none; 
            }

            .header {
                text-align: center; 
                margin-bottom: 20px;
            }

            .header img {
                max-width: 150px; 
                margin-bottom: 10px;
            }

            .footer {
                margin-top: 20px;
                text-align: left; 
            }
        }

        
        body {
            font-size: 10pt; 
        }

        .container {
            margin-top: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 200px;
            margin-bottom: 10px;
        }

        .table-bordered {
            border: 1px solid #dee2e6; 
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }

        img {
            max-width: 100px;
            height: auto;
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
        .terlambat {
        color: red;
        }
        .tepat-waktu {
         color: green;
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
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo SMKN 1 Kepanjen" class="img-fluid">
            <h2>SMK NEGERI 1 KEPANJEN</h2>
            <h6>Jl. Raya Kedungpedaringan, Kepanjen, Malang, Jawa Timur 65163</h6>
            <hr><h4 class="report-title">Laporan Absen Masuk Guru</h4>
            <h6>Periode: Januari 2025</h6>
        </div>

        <div class="no-print">  <form method="GET" action="">
                <div class="row mb-3">
                    <div class="col-auto" id="bulan_select">
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
                            $tahun_awal = 2020;
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
        </div>  

        <table class="table table-transparent table-hover table-bordered mt-5">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>ID Guru</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Foto</th>
                    <th>Keterangan</th>
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
                    if ($siswa['keterangan'] == 'sakit' || $siswa['keterangan'] == 'izin') {
                        $status = '-';
                    }
                    ?>
                             <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $siswa['id_guru'] ?></td>
                                <td><?php echo $siswa['nama'] ?></td>
                                <td><?php echo $siswa['tanggal_waktu'] ?></td>
                                <td class="<?php echo $status == '-' ? '' : $status; ?>">
                                <?php
                                if ($status == '-') {
                                    echo '-';
                                } else {
                                    echo ($status == 'terlambat') ? 'Terlambat' : 'Tepat Waktu';
                                }
                                ?>
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
                            </tr>
                            <?php $i++;
                        endwhile;
                    } else {
                        echo "<tr><td colspan='9'>Error: " . mysqli_error($conn) . "</td></tr>";
                    }
                    ?>
                </tbody>
     </table>

        <div class="footer">
            <h6>Total Guru: <?= mysqli_num_rows($query) ?></h6>
            <h6>Tanggal Cetak: <?= date('Y-m-d') ?></h6>
        </div>

        <div class="no-print">
        <button class="btn btn-primary no-print" onclick="window.print()">Cetak</button>
        <a href="LIST-M-GURU.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>