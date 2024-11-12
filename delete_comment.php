<?php
// Hubungkan ke database
include 'database.php';

// Periksa apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    // Amankan ID dengan filter_input untuk menghindari SQL Injection
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Siapkan pernyataan SQL untuk menghapus komentar berdasarkan ID
    $delete_query = "DELETE FROM kometar WHERE id = ?";

    if ($stmt = $conn->prepare($delete_query)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Jika berhasil, kembali ke halaman komentar dengan pesan sukses
            header("Location: contact.php?delete_success=true");
            exit;
        } else {
            echo "<p class='text-danger'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p class='text-danger'>Error preparing statement: " . $conn->error . "</p>";
    }
} else {
    echo "<p class='text-danger'>Invalid ID parameter.</p>";
}

// Tutup koneksi database
$conn->close();
?>
