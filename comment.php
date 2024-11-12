<?php
// Menyertakan file koneksi database
include "database.php";

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Memeriksa apakah request yang diterima adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $foto_id = $_POST['foto_id'];
    $nama = $_POST['nama'];
    $message = $_POST['message'];

    // Menyiapkan statement SQL untuk menyimpan komentar
    $stmt = $conn->prepare("INSERT INTO komentar1 (foto_id, nama, message) VALUES (?, ?, ?)");

    // Memeriksa apakah statement berhasil disiapkan
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Mengikat parameter ke statement
    $stmt->bind_param("iss", $foto_id, $nama, $message);

    // Menjalankan statement
    if ($stmt->execute()) {
        // Redirect kembali ke halaman galeri setelah menyimpan komentar
        header("Location: index.php");
        exit();
    } else {
        // Menampilkan pesan kesalahan jika eksekusi gagal
        echo "Error executing query: " . $stmt->error;
    }

    // Menutup statement
    $stmt->close();
}

// Menutup koneksi
$conn->close();
?>
