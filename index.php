<?php
require_once 'connection.php';

$query = "SELECT mahasiswa.id, mahasiswa.nama AS nama_mahasiswa, jurusan.nama_jurusan, angkatan.tahun 
          FROM mahasiswa 
          JOIN jurusan ON mahasiswa.jurusan_id = jurusan.id 
          JOIN angkatan ON mahasiswa.angkatan_id = angkatan.id";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>List Mahasiswa</title>
</head>
<body>

<div class="container">
    <h1>Data Mahasiswa</h1>
    <?php
    session_start();
    if (isset($_SESSION['success_message'])) {
        echo '<script>alert("' . $_SESSION['success_message'] . '");</script>';
        unset($_SESSION['success_message']);
    }
    ?>
    <a href="create.php" class="btn btn-primary">Tambah Mahasiswa</a>
    <table class="table table-striped">
        <tr>
            <th>Nama Mahasiswa</th>
            <th>Jurusan</th>
            <th>Angkatan</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['nama_mahasiswa']; ?></td>
                    <td><?php echo $row['nama_jurusan']; ?></td>
                    <td><?php echo $row['tahun']; ?></td>
                    <td>
                        <!-- Use $row['id'] in the link -->
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Edit</a>
                        <a href="<?php echo 'delete.php?id=' . $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="4">No data here!</td>
            </tr>
            <?php
        }
        ?>

    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
