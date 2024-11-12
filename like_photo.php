<?php
session_start();
include "database.php"; // Koneksi ke database

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id']; // ID pengguna yang login
$foto_id = $_POST['foto_id']; // ID foto yang di-like

// Cek apakah like sudah ada di database
$query = "SELECT * FROM likefoto WHERE FotoID = ? AND UserID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $foto_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Jika sudah like, maka hapus like (unlike)
    $deleteQuery = "DELETE FROM likefoto WHERE FotoID = ? AND UserID = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param('ii', $foto_id, $user_id);
    $stmt->execute();
    echo json_encode(['success' => true]);
} else {
    // Jika belum like, tambahkan like
    $insertQuery = "INSERT INTO likefoto (FotoID, UserID, TanggalLike) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param('ii', $foto_id, $user_id);
    $stmt->execute();
    echo json_encode(['success' => true]);
}
?>
