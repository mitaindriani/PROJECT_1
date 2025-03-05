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
            document.location.href = 'formpulang.php'; // Atau halaman lain yang sesuai
        </script>";
    exit(); // Hentikan eksekusi kode selanjutnya
}

// Ambil jam pulang dari database berdasarkan hari ini
$hari_ini = date('l'); // 'l' format untuk nama hari (e.g., Monday, Tuesday)
$sql_jam_pulang = "SELECT jam_pulang FROM master_jadwal WHERE hari = '$hari_ini'";
$result_jam_pulang = $conn->query($sql_jam_pulang);

if ($result_jam_pulang->num_rows > 0) {
    $row_jam_pulang = $result_jam_pulang->fetch_assoc();
    $jam_pulang = $row_jam_pulang['jam_pulang'];

    // Pastikan $jam_pulang tidak NULL dan merupakan string yang valid
    if ($jam_pulang !== null && is_string($jam_pulang)) {
        // Ubah format jam pulang ke menit (misalnya, 15:30 menjadi 930 menit)
        $jam_pulang_menit = explode(":", $jam_pulang);
        $jam_pulang_total_menit = ($jam_pulang_menit[0] * 60) + $jam_pulang_menit[1];

        // Ambil waktu saat ini dan ubah ke menit
        $waktu_sekarang = date("H:i");
        $waktu_sekarang_menit = explode(":", $waktu_sekarang);
        $waktu_sekarang_total_menit = ($waktu_sekarang_menit[0] * 60) + $waktu_sekarang_menit[1];

        // Bandingkan waktu sekarang dengan jam pulang
        if ($waktu_sekarang_total_menit < $jam_pulang_total_menit) {
            echo "<script>
                    alert('Maaf, belum waktunya pulang. Jam pulang hari ini adalah $jam_pulang.');
                    document.location.href = 'formpulang.php'; // Atau halaman lain yang sesuai
                </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('Format jam pulang tidak valid untuk hari ini.');
                document.location.href = 'formpulang.php'; // Atau halaman lain yang sesuai
            </script>";
        exit();
    }
} else {
    echo "<script>
            alert('Jadwal pulang belum diatur untuk hari ini.');
            document.location.href = 'formpulang.php'; // Atau halaman lain yang sesuai
        </script>";
    exit();
}

// Cek apakah form telah dikirim (setelah pengecekan waktu)
if (isset($_POST['daftar'])) {
    // Ambil data dari form
    $nama = htmlspecialchars($_POST['nama']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $tanggal_waktu_string = $_POST['tanggal_waktu'];

    $dateTime = new DateTime($tanggal_waktu_string);

    // Simpan data ke database (tanpa gambar)
    $sql = "INSERT INTO tb_pulang (nama, kelas, jurusan, tanggal_waktu)
            VALUES ('$nama', '$kelas', '$jurusan', '$tanggal_waktu_string')";

    $result = $conn->query($sql);

    if ($result) {
        // kalau berhasil alihkan ke halaman list-siswa.php
        header('Location: listpulang.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }
} else {
    //die("Akses dilarang...");
}
?>