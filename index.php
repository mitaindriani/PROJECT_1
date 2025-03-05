<?php
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
      margin-top: 70px;
      font-family: sans-serif;
      background-image: url("nesa.jpeg");
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      overflow-y: auto;
      background-attachment: fixed;
    }

    .box-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
      overflow: hidden;
    }

    .home-box:hover,
    .boxx:hover {
      transform: scale(1.05);
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
    }

    .home-box:hover,
    .boxx1:hover {
      transform: scale(1.05);
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
    }

    .home-box {
      background-color: #fefefeef;
      padding: 80px;
      border-radius: 25px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      width: 50%;
      text-align: center;
      margin-top: 90px;
      margin-bottom: 20px;
      transition: background-color 0.3s ease;
    }

    .flex-container {
      display: flex;
      justify-content: space-between;
      width: 90%;
      margin-bottom: 50px;
      gap: 20px;
    }

    .boxx {
      background-color: #fefefeef;
      padding: 80px;
      border-radius: 25px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      width: 60%;
      text-align: center;
      transition: background-color 0.3s ease;
    }

    .boxx1 {
      background-color: #fefefeef;
      padding: 65px;
      border-radius: 25px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      width: 90%;
      max-width: 3000px;
      text-align: center;
      margin: 0 auto 20px;
      transition: background-color 0.3s ease;
      margin-bottom: 20px; 
    }

    li {
      text-align: left;
    }

    .boxx:hover {
      background-color: #c5cbd1;
    }

    .boxx1:hover {
      background-color: #c5cbd1;
    }

    p {
      text-align: justify;
    }

    .kanesa-img {
      position: relative;
      margin-top: 20px;
      width: 550px;
      max-width: 90%;
      height: auto;
    }

    .social-media-icons {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .social-media-icons a {
      margin: 0 10px;
    }

    .social-media-icons img {
      transition: transform 0.3s ease;
    }

    .social-media-icons img:hover {
      transform: scale(1.1);
    }

    .footer {
      position: relative;
      left: 0;
      bottom: 0;
      width: 100%;
      background-color: #22242A;
      color: #e8e8e8;
      text-align: center;
      padding: 10px;
    }
  </style>
</head>

<body>
  <nav>
    <div class="logo">
      <img src="logo.png" width="50px" height="50px">
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

  <div class="content"><br>
    <div class="box-container" id="boxContainer">
      <div class="flex-container">
        <div class="boxx">
          <h2>Visi SMKN 1 Kepanjen </h2>
          <p>Mewujudkan sekolah menengah kejuruan Negeri 1 Kepanjen sebagai lembaga
            pendidikan kejuruan yang menghasilkan sumber daya manusia berkarakter
            berkompeten di bidangnya dan berjiwa wirausaha.</p>
        </div>
        <div class="boxx">
          <h2>Jurusan: </h2>
          <ul>
            <li>(TKR) Teknik Kendaraan Ringan Otomotif.</li>
            <li>(TBSM) Teknik dan Bisnis Sepeda Motor.</li>
            <li>(TEI) Teknik Elektronika Industri.</li>
            <li>(RPL) Rekayasa Perangkat Lunak.</li>
            <li>(TKJ) Teknik Komputer dan Jaringan.</li>
          </ul>
        </div>
      </div>
      <div class="boxx1">
        <h2>Misi SMKN 1 Kepanjen</h2>
        <ol>
          <li>Mewujudkan kurikulum yang relevan dan kebutuhan dan berwawasan nasional.</li>
          <li>Mewujudkan pembelajaran aktif kreatif efektif dan menyenangkan.</li>
          <li>Mewujudkan penilaian autentik pada kompetensi pengetahuan keterampilan dan sikap.</li>
          <li>Mewujudkan peningkatan prestasi lulusan.</li>
          <li>Menumbuhkembangkan budaya karakter bangsa.</li>
          <li>Mengembangkan potensi peserta didik dalam menggunakan pengetahuan dan teknologi.</li>
          <li>Mengembangkan kemampuan olahraga dan seni yang tangguh dan kompetitif.</li>
          <li>Menerapkan penyelenggaraan sekolah berwawasan lingkungan.</li>
          <li>Mewujudkan fasilitas sekolah yang berbasis IT.</li>
          <li>Memiliki tenaga guru yang bersertifikasi profesional.</li>
          <li>Mengembangkan kompetensi tenaga pendidik dan kependidikan</li>
          <li>Menyelenggarakan manajemen berbasis sekolah.</li>
          <li>Melaksanakan unit produksi dan jasa sekolah.</li>
          <li>Meningkatkan kerjasama dengan komite sekolah, dunia industri dan dunia usaha.</li>
          <li>Mewujudkan pengelolaan pembiayaan pendidikan yang memadai wajar dan adil.</li>
          <li>Memperkuat pembelajaran yang berwawasan kewirausahaan</li>
        </ol>
      </div>
    </div>
  </div>
  <script>
    const boxContainer = document.getElementById('boxContainer');
    let currentPosition = 0; // Melacak posisi vertikal saat ini
    const boxHeight = document.querySelector('.home-box').offsetHeight + 40;
    const maxPosition = boxContainer.scrollHeight - boxContainer.clientHeight; // Hitung posisi scroll maksimum

    window.addEventListener('wheel', (event) => {
      event.preventDefault();

      currentPosition -= event.deltaY; // Sesuaikan posisi berdasarkan arah scroll

      // Batasan scroll
      currentPosition = Math.max(0, Math.min(currentPosition, maxPosition));

      boxContainer.style.transform = `translateY(-${currentPosition}px)`; 
    });
  </script>
  <div class="footer">
    <a href="https://www.instagram.com/smkn1kepanjen?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
      <img src="ig.png" alt="Instagram" width="50" height="50">
    </a>
    <a href="https://www.tiktok.com/@smkn1kepanjen?is_from_webapp=1&sender_device=pc" target="_blank">
      <img src="tiktok.png" alt="TikTok" width="50" height="50">
    </a>
    <a href="http://www.youtube.com/@SMKNEGERI1KEPANJEN" target="_blank">
      <img src="yt.png" alt="YouTube" width="50" height="50">
    </a>
  </div>
</body>

</html>
