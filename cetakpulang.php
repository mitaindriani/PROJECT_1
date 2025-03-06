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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="kanesa.png" alt="Logo SMKN 1 Kepanjen" class="img-fluid">
            <h2>SMK NEGERI 1 KEPANJEN</h2>
            <h6>Jl. Raya Kedungpedaringan, Kepanjen, Malang, Jawa Timur 65163</h6>
            <hr><h4 class="report-title">Laporan Absen Pulang Siswa</h4>
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
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Tanggal & waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $filter_by = isset($_GET['filter_by']) ? $_GET['filter_by'] : 'bulan';
                $bulan_dipilih = isset($_GET['bulan']) ? $_GET['bulan'] : '';
                $kelas_dipilih = isset($_GET['kelas']) ? $_GET['kelas'] : '';
                $tahun_dipilih = isset($_GET['tahun']) ? $_GET['tahun'] : '';

                $sql = "SELECT * FROM tb_pulang";
                $where_clause = "";

                if ($filter_by == 'bulan') {
                    if (!empty($bulan_dipilih)) {
                        $where_clause .= "MONTH(tanggal) = '$bulan_dipilih'";
                    }
                } else if ($filter_by == 'kelas') {
                    if (!empty($kelas_dipilih)) {
                        $where_clause .= "kelas = '$kelas_dipilih'";
                    }
                }

                if (!empty($tahun_dipilih)) {
                    if (!empty($where_clause)) {
                        $where_clause .= " AND ";
                    }
                    $where_clause .= "YEAR(tanggal) = '$tahun_dipilih'";
                }

                if (!empty($where_clause)) {
                    $sql .= " WHERE " . $where_clause;
                }
                $sql = "SELECT * FROM tb_pulang";
                $query = mysqli_query($conn, $sql);
                $i = 1;
                ?>

                <?php while ($siswa = mysqli_fetch_array($query)) : ?>
                    <tr>
                        <td><?php echo $i ?> </td>
                        <td><?php echo $siswa['nama'] ?></td>
                        <td><?php echo $siswa['kelas'] ?></td>
                        <td><?php echo $siswa['jurusan'] ?></td>
                        <td><?php echo $siswa['tanggal_waktu'] ?></td>
                    </tr>
                    <?php $i++ ?>
                    <?php endwhile; ?>
             </tbody>
        </table>

        <div class="footer">
            <h6>Total Guru: <?= mysqli_num_rows($query) ?></h6>
            <h6>Tanggal Cetak: <?= date('Y-m-d') ?></h6>
        </div>

        <div class="no-print">
        <button class="btn btn-primary no-print" onclick="window.print()">Cetak</button>
        <a href="listpulang.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>