<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $jurusan_id = $_POST['jurusan_id'];
    $angkatan_id = $_POST['angkatan_id'];

    $insertQuery = "INSERT INTO mahasiswa (nama, jurusan_id, angkatan_id) 
                    VALUES ('$nama', '$jurusan_id', '$angkatan_id')";

    if ($conn->query($insertQuery) === TRUE) {
        session_start();
        $_SESSION['success_message'] = "Data Mahasiswa Berhasil Ditambah!";
        // Redirect to index.php
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
} else {
    echo "Form submission error!";
}
?>
