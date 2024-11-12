<?php
session_start();
include 'database.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Cek pengguna di database
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Login sukses
            $_SESSION['username'] = $username;
            header("Location: index.php"); // Redirect ke halaman dashboard
            exit();
        } else {
            $_SESSION['error'] = "Password salah."; // Simpan pesan error
            header("Location: looin.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Pengguna tidak ditemukan."; // Simpan pesan error
        header("Location: looin.php");
        exit();
    }
}

$conn->close();
?>
