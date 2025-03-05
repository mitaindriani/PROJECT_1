<?php
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $id_guru = $_POST['id_guru'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];

    $sql = null; 

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "images/";
        $foto_name = basename($_FILES["foto"]["name"]);
        $target_file = $target_dir . $foto_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if ($_FILES["foto"]["size"] > 500000) {
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                if (isset($_POST['old_foto']) && !empty($_POST['old_foto']) && file_exists($target_dir . $_POST['old_foto'])) {
                    unlink($target_dir . $_POST['old_foto']);
                }

                $sql = "UPDATE tb_guru SET id_guru='$id_guru', nama='$nama', foto='$foto_name' WHERE id='$id'";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        if (isset($_POST['old_foto']) && !empty($_POST['old_foto'])) {
            $sql = "UPDATE tb_guru SET id_guru='$id_guru', nama='$nama',  keterangan='$keterangan' WHERE id='$id'";
        } else {
            $sql = "UPDATE tb_guru SET id_guru='$id_guru', nama='$nama', keterangan='$keterangan' WHERE id='$id'";
        }
    }

    if ($sql !== null) {
        if (mysqli_query($conn, $sql)) {
            header("Location: LIST-M-GURU.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}
?>