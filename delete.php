<?php
require_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $conn->prepare("SELECT id FROM mahasiswa WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
        $deleteQuery = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
        $deleteQuery->bind_param("i", $id);

        if ($deleteQuery->execute()) {
            session_start();
            $_SESSION['success_message'] = "Data Mahasiswa Berhasil Dihapus!";
            header('Location: index.php');
            exit();
        } else {
            echo "Error: " . $deleteQuery->error;
        }

        $deleteQuery->close();
    } else {
        header('Location: index.php');
    }

    $query->close();
} else {
    header('Location: index.php');
}
?>
