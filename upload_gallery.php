<?php
// Pastikan session dan koneksi database sudah disiapkan sebelumnya
include "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
    // Proses upload foto
    $title = $_POST['title'];
    $photo = $_FILES['photo'];

    // Tentukan lokasi folder upload
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($photo['name']);
    
    // Validasi file (misalnya hanya gambar yang diperbolehkan)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($photo['type'], $allowedTypes)) {
        echo "Format file tidak valid. Harap upload file gambar.";
        exit();
    }

    // Tentukan nama file unik untuk menghindari duplikasi
    $fileExtension = pathinfo($photo['name'], PATHINFO_EXTENSION);
    $uniqueFileName = uniqid() . '.' . $fileExtension;
    $uploadFile = $uploadDir . $uniqueFileName;

    // Pastikan folder 'uploads/' ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Membuat folder dengan izin penuh
    }

    // Cek apakah file berhasil dipindahkan
    if (move_uploaded_file($photo['tmp_name'], $uploadFile)) {
        // Mendapatkan tanggal upload
        $tanggalUpload = date("Y-m-d H:i:s");

        // Masukkan data ke dalam database
        $query = "INSERT INTO foto_coba (JudulFoto, LokasiFile, TanggalUpload) VALUES ('$title', '$uploadFile', '$tanggalUpload')";
        if (mysqli_query($conn, $query)) {
            // Setelah upload berhasil, alihkan ke halaman index
            header("Location: index.php");
            exit();
        } else {
            echo "Gagal menyimpan data foto ke database.";
        }
    } else {
        echo "Gagal mengupload foto.";
    }
} else {
    echo "Foto tidak ditemukan.";
}
?>
