<?php
include 'database.php';

// Pastikan ada foto_id yang dikirim
if (isset($_POST['foto_id'])) {
    $foto_id = (int)$_POST['foto_id'];

    // Ambil status like untuk foto ini dari database
    $query = mysqli_query($conn, "SELECT likes FROM foto_coba WHERE FotoID = $foto_id");
    $data = mysqli_fetch_assoc($query);

    // Jika data ada
    if ($data) {
        // Increment atau decrement jumlah like
        $new_likes = $data['likes'] + 1;

        // Update jumlah like di database
        $updateQuery = "UPDATE foto_coba SET likes = $new_likes WHERE FotoID = $foto_id";
        mysqli_query($conn, $updateQuery);

        // Kembalikan data dalam format JSON
        echo json_encode([
            'likes' => $new_likes,
            'liked' => true
        ]);
    }
}
?>
