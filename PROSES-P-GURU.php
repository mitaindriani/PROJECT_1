<?php
include("conn.php");

// Fungsi untuk mendapatkan hari saat ini (0 = Minggu, 6 = Sabtu)
function getHari() {
    return date('w');
}

// Cek apakah hari ini Sabtu atau Minggu
if (getHari() == 6 || getHari() == 0) {
    echo "<script>
            alert('Tidak dapat melakukan absensi pada hari Sabtu dan Minggu.');
            document.location.href = 'GURUPULANG.php'; // Atau halaman lain yang sesuai
          </script>";
    exit(); // Hentikan eksekusi kode selanjutnya
}

// Cek apakah form telah dikirim
if (isset($_POST['daftar'])) {
  // Ambil data dari form
  $id_guru = htmlspecialchars($_POST['id_guru']);
  $nama = htmlspecialchars($_POST['nama']);
  $tanggal_waktu_string = $_POST['tanggal_waktu'];

  $dateTime = new DateTime($tanggal_waktu_string);

    echo "Waktu yang diambil: " . $time . "<br>";
  // Simpan data ke database (tanpa gambar)
  $sql = "INSERT INTO tb_guru2 (id_guru, nama, tanggal_waktu)
          VALUES ('$id_guru', '$nama', '$tanggal_waktu_string')";

  $result = $conn->query($sql);

  if ($result) {
    // kalau berhasil alihkan ke halaman list-siswa.php
    header('Location: LIST-P-GURU.php');
    } else {
    // kalau gagal tampilkan pesan
    die("Gagal menyimpan perubahan...");
    }
    } else {
    die("Akses dilarang...");
    }