<?php
include "database.php"; // Pastikan database.php berfungsi dengan benar

if (isset($_GET['foto_id'])) {
    $foto_id = $_GET['foto_id'];

    // Query untuk mendapatkan lokasi file foto
    $query = mysqli_query($conn, "SELECT LokasiFile FROM foto_coba WHERE FotoID = '$foto_id'");
    $data = mysqli_fetch_assoc($query);

    // Jika foto ditemukan, hapus file dari server
    if ($data) {
        $file_path = $data['LokasiFile'];
        if (file_exists($file_path)) {
            unlink($file_path); // Menghapus file fisik
        }
        
        // Menghapus data foto dari database
        $delete_query = mysqli_query($conn, "DELETE FROM foto_coba WHERE FotoID = '$foto_id'");
        if ($delete_query) {
            header("Location: index.php"); // Redirect kembali ke galeri setelah penghapusan
            exit;
        } else {
            echo "Gagal menghapus foto dari database.";
        }
    } else {
        echo "Foto tidak ditemukan.";
    }
} else {
    echo "ID foto tidak valid.";
}
?>
