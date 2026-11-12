<?php
    //1. Panggil file koneksi (sama seperti tugas 1 dan tugas 2)
    require 'koneksi.php';

    //2. Ambil id dari link (hapus.php?id=...) memakai $_GET['id'].
    //Beri nilai default '' jika id tidak ada.
    $id = $_GET['id'] ?? '';

    if($id === '' || !ctype_digit($id)) {
        echo '<p style="color:red;">!! ID tidak valid. !!</p>';
    } else {
        $stmt = mysqli_prepare($conn, 'DELETE FROM film WHERE id = ?');
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);

        if(mysqli_stmt_affected_rows($stmt) == 1){
            echo '<p>Data berhasil dihapus.</p>';
        } else {
            echo '<p>Data tidak ditemukan.</p>';
        }
    }
     echo '<a href= "index.php">Kembali</a>';
?>