<?php
include("conn.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

date_default_timezone_set('Asia/Jakarta');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $tanggal_waktu = date('Y-m-d H:i:s');
    $keterangan = $_POST['keterangan'];

    // Ambil hari saat ini
    $hari_ini = date('l', strtotime($tanggal_waktu));

    // Ambil jam masuk dari master_jadwal
    $sql_jadwal = "SELECT jam_masuk FROM master_jadwal WHERE hari = '$hari_ini'";
    $result_jadwal = mysqli_query($conn, $sql_jadwal);

    if ($result_jadwal && $row_jadwal = mysqli_fetch_assoc($result_jadwal)) {
        $jam_masuk_jadwal = $row_jadwal['jam_masuk'];

        // Validasi waktu absen
        if (!empty($jam_masuk_jadwal)) {
            $jam_masuk_jadwal_dt = new DateTime($jam_masuk_jadwal);
            $jam_absen_dt = new DateTime($tanggal_waktu);

            // Set tanggal jam_masuk_jadwal agar sesuai dengan tanggal jam_absen_dt
            $jam_masuk_jadwal_dt->setDate($jam_absen_dt->format('Y'), $jam_absen_dt->format('m'), $jam_absen_dt->format('d'));

            if ($jam_absen_dt > $jam_masuk_jadwal_dt) {
                $status = 'Terlambat';
            } else {
                $status = 'Tepat Waktu';
            }
        } else {
            $status = 'Tepat Waktu'; // Jika jam masuk tidak diatur, anggap tepat waktu
        }
    } else {
        $status = 'Tepat Waktu'; // Jika jadwal tidak ditemukan, anggap tepat waktu
    }

    // Upload foto
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

    $sql = "INSERT INTO tb_absen (nama, kelas, jurusan, tanggal_waktu, foto, keterangan, status) VALUES ('$nama', '$kelas', '$jurusan', '$tanggal_waktu', '" . basename($_FILES["foto"]["name"]) . "', '$keterangan', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Absen berhasil.'); window.location.href='listmasuk.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>