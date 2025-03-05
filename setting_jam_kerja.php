<?php
include("conn.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

date_default_timezone_set('Asia/Jakarta');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $success = true;

    foreach ($days as $day) {
        $jam_masuk = $_POST['jam_masuk'][$day];
        $jam_pulang = $_POST['jam_pulang'][$day];

        if (empty($jam_masuk)) {
            $jam_masuk = null;
        }
        if (empty($jam_pulang)) {
            $jam_pulang = null;
        }

        $sql = "INSERT INTO master_jadwal (hari, jam_masuk, jam_pulang) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE jam_masuk = ?, jam_pulang = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssss", $day, $jam_masuk, $jam_pulang, $jam_masuk, $jam_pulang);

            if (!$stmt->execute()) {
                echo "<script>alert('Error for " . $day . ": " . $stmt->error . "');</script>";
                $success = false;
                break;
            }
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
            $success = false;
            break;
        }
    }
    if ($success) {
        echo "<script>alert('Jadwal berhasil disimpan.');</script>";
    }
}

$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
$jadwal = [];
foreach ($days as $day) {
    $sql = "SELECT jam_masuk, jam_pulang FROM master_jadwal WHERE hari = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $day);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $jadwal[$day]['jam_masuk'] = $row['jam_masuk'];
            $jadwal[$day]['jam_pulang'] = $row['jam_pulang'];
        } else {
            $jadwal[$day]['jam_masuk'] = '';
            $jadwal[$day]['jam_pulang'] = '';
        }
        $stmt->close();
    } else {
        echo "error preparing statement";
    }
}
// debugging
//print_r($jadwal);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Jam Kerja (Senin-Jumat)</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Gaya CSS dari kode sebelumnya */
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

        body {
            background-color: #D9EAFD;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
        }

        .form-container table {
            width: 100%;
        }

        .form-container th,
        .form-container td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
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
            <li><a href="setting_jam_kerja.php"><i class='bx bx-log-in'></i>Master Jadwal</a></li>
            <li><a href="contact.php"><i class='bx bxs-cog'></i> Contact</a></li>
            <li><a href="logout.php"><i class='bx bx-log-in'></i> Logout</a></li>
        </ul>
    </nav>

    <div class="content">
        <div class="form-container">
            <h2>Setting Jam Kerja (Senin-Jumat)</h2>
            <form method="POST" action="">
                <table>
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($days as $day) : ?>
                            <tr>
                                <td><?php echo date('l', strtotime("2023-01-02 + " . array_search($day, $days) . " days")); ?></td>
                                <td><input type="datetime-local" name="jam_masuk[<?php echo $day; ?>]" value="<?php echo ($jadwal[$day]['jam_masuk'] != '') ? date('Y-m-d\TH:i', strtotime($jadwal[$day]['jam_masuk'])) : ''; ?>"></td>
                                <td><input type="datetime-local" name="jam_pulang[<?php echo $day; ?>]" value="<?php echo ($jadwal[$day]['jam_pulang'] != '') ? date('Y-m-d\TH:i', strtotime($jadwal[$day]['jam_pulang'])) : ''; ?>"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary mt-3">Simpan Semua</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>