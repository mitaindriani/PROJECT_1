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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact form</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylea.css">
</head>
<body>
    <div class="container">
        <h1>Hubungi Kami</h1>
        <p>Ada pertanyaan atau masukan mengenai sistem absensi kami?</p>
        <p>Silakan isi formulir di bawah ini dan kami akan segera menghubungi Anda.</p></br>
        <form action="kirim_email.php" method="POST">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject">
            <label for="message">Pesan</label>
            <textarea name="message" cols="30" rows="10"></textarea>
            <input type="submit" value="Send">
        </form>
    </div>
</body>
</html>