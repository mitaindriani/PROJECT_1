<?php
include("conn.php");

// Ambil data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$tanggal = $_POST['tanggal'];
$time = $_POST['time'];

// Update data siswa di database
$sql = "UPDATE tb_pulang SET nama='$nama', kelas='$kelas', jurusan='$jurusan', tanggal='$tanggal', time='$time' WHERE id=$id";
$query = mysqli_query($conn, $sql);

if ($query) {
    header("Location: listpulang.php?status=success");
} else {
    header("Location: listpulang.php?status=error");
}
?>