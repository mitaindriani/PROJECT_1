<?php
include("conn.php");

// Ambil data dari form
$id = $_POST['id'];
$id_guru = $_POST['id_guru'];
$nama = $_POST['nama'];
$tanggal_waktu = $_POST['tanggal_waktu'];

// Update data siswa di database
$sql = "UPDATE tb_guru2 SET id_guru='$id_guru', nama='$nama', tanggal_waktu='$tanggal_waktu' WHERE id=$id";
$query = mysqli_query($conn, $sql);

if ($query) {
    header("Location: LIST-P-GURU.php?status=success");
} else {
    header("Location: LIST-P-GURU.php?status=error");
}
?>