<?php
session_start();

require_once 'connection.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $mahasiswa = $result->fetch_assoc();
} else {
    header('Location: index.php');
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Mahasiswa</title>
</head>
<body>

<div class="container">
    <h1>Edit Mahasiswa</h1>
    <form action="update.php" method="POST">
        <input type="text" name="id" value="<?php echo $mahasiswa['id'] ?>" hidden>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $mahasiswa['nama'] ?>">
        </div>

        <div class="mb-3">
            <label for="jurusan_id" class="form-label">Jurusan</label>
            <select class="form-select" id="jurusan_id" name="jurusan_id" required>
                <?php
                $jurusanQuery = "SELECT * FROM jurusan";
                $jurusanResult = $conn->query($jurusanQuery);
                while ($jurusan = $jurusanResult->fetch_assoc()) {
                    $selected = ($jurusan['id'] == $mahasiswa['jurusan_id']) ? 'selected' : '';
                    echo '<option value="' . $jurusan['id'] . '" ' . $selected . '>' . $jurusan['nama_jurusan'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="angkatan_id" class="form-label">Angkatan</label>
            <select class="form-select" id="angkatan_id" name="angkatan_id" required>
                <?php
                $angkatanQuery = "SELECT * FROM angkatan";
                $angkatanResult = $conn->query($angkatanQuery);
                while ($angkatan = $angkatanResult->fetch_assoc()) {
                    $selected = ($angkatan['id'] == $mahasiswa['angkatan_id']) ? 'selected' : '';
                    echo '<option value="' . $angkatan['id'] . '" ' . $selected . '>' . $angkatan['tahun'] . '</option>';
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
