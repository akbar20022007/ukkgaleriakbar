<?php
// Mulai sesi jika belum dimulai
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Baca data galeri dari file JSON
$gallery_file = 'gallery.json';
$gallery_data = file_exists($gallery_file) ? json_decode(file_get_contents($gallery_file), true) : [];

// Fungsi untuk menghapus foto dari galeri dan JSON
function deletePhoto($photoToDelete) {
    global $gallery_file;
    $gallery_data = json_decode(file_get_contents($gallery_file), true);
    
    foreach ($gallery_data as $key => $item) {
        if ($item['photo'] === $photoToDelete) {
            // Hapus file gambar
            if (file_exists("uploads/gallery/" . $photoToDelete)) {
                unlink("uploads/gallery/" . $photoToDelete);
            }
            // Hapus data dari array
            unset($gallery_data[$key]);
            break;
        }
    }
    
    // Simpan kembali data galeri yang diperbarui ke file JSON
    file_put_contents($gallery_file, json_encode(array_values($gallery_data), JSON_PRETTY_PRINT));
}

// Cek apakah ada permintaan penghapusan foto
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $photoToDelete = basename($_GET['delete']);
    deletePhoto($photoToDelete);
    header("Location: gallery.php"); // Redirect ke halaman galeri setelah penghapusan
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .gallery-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 200px;
            text-align: center;
        }
        .gallery-item img {
            width: 100%;
            height: auto;
        }
        .gallery-item h3 {
            margin: 10px 0;
            font-size: 16px;
            color: #333;
        }
        .logout {
            text-align: right;
            margin-bottom: 20px;
        }
        .delete {
            color: red;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>
    <h1>Galeri Foto</h1>
    <div class="gallery">
        <?php if (empty($gallery_data)): ?>
            <p>Tidak ada foto dalam galeri.</p>
        <?php else: ?>
            <?php foreach ($gallery_data as $item): ?>
                <div class="gallery-item">
                    <img src="uploads/gallery/<?php echo htmlspecialchars($item['photo']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                    <div>
                        <a href="?delete=<?php echo urlencode($item['photo']); ?>" class="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">Hapus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
