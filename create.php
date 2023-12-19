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
}

//dropdown
$jurusanQuery = "SELECT * FROM jurusan";
$jurusanResult = $conn->query($jurusanQuery);

$angkatanQuery = "SELECT * FROM angkatan";
$angkatanResult = $conn->query($angkatanQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Tambah Data Mahasiswa</title>
</head>
<body>

<div class="container">
    <h1>Tambah Data Mahasiswa</h1>
    <form action="create.php" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="jurusan_id" class="form-label">Jurusan</label>
            <select class="form-select" id="jurusan_id" name="jurusan_id" required>
                <option value="" selected disabled>Pilih Jurusan</option>
                <?php
                while ($jurusan = $jurusanResult->fetch_assoc()) {
                    echo '<option value="' . $jurusan['id'] . '">' . $jurusan['nama_jurusan'] . '</option>';
                }
                $jurusanResult->data_seek(0);
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="angkatan_id" class="form-label">Angkatan</label>
            <select class="form-select" id="angkatan_id" name="angkatan_id" required>
                <option value="" selected disabled>Pilih Angkatan</option>
                <?php
                while ($angkatan = $angkatanResult->fetch_assoc()) {
                    echo '<option value="' . $angkatan['id'] . '">' . $angkatan['tahun'] . '</option>';
                }
                $angkatanResult->data_seek(0);
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- script for success alert -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php
        if (isset($_SESSION['success_message'])) {
            echo 'alert("' . $_SESSION['success_message'] . '");';
            unset($_SESSION['success_message']);
        }
        ?>
    });
</script>
</body>
</html>
