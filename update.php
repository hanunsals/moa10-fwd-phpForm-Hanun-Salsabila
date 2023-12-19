<?php
require_once 'connection.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$jurusan_id = $_POST['jurusan_id'];
$angkatan_id = $_POST['angkatan_id'];

$query = "UPDATE mahasiswa
          SET nama = '$nama', 
              jurusan_id = $jurusan_id, 
              angkatan_id = $angkatan_id
          WHERE id = $id";

if ($conn->query($query) === TRUE) {
    session_start();
    $_SESSION['success_message'] = 'Data Mahasiswa Berhasil Diubah!';
    header('Location: index.php');
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
