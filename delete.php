<?php
include 'database.php';

if (isset($_GET['id'])) {
    // Sanitasi input
    $id = intval($_GET['id']);

    // Query untuk menghapus komentar berdasarkan ID
    $delete_query = "DELETE FROM kometar WHERE id = ?";
    
    if ($stmt = $conn->prepare($delete_query)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<p class='text-success'>Komentar berhasil dihapus.</p>";
        } else {
            echo "<p class='text-danger'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p class='text-danger'>Error preparing statement: " . $conn->error . "</p>";
    }

    // Redirect kembali ke halaman utama setelah penghapusan
    header("Location: contact.php");
} else {
    echo "<p class='text-danger'>ID tidak valid.</p>";
}

// Tutup koneksi
$conn->close();
?>
