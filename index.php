<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UKK Galeri Foto</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tooplate-style.css">
    <style>
        /* Penataan Galeri */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Lebar minimum diperbesar menjadi 200px */
            gap: 10px;
            margin-top: 20px;
        }

        .grid-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            max-height: 250px; /* Menetapkan tinggi maksimum untuk membatasi ukuran foto */
        }

        .grid-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .grid-item img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .like-button {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
            font-size: 14px; /* Perkecil ukuran font */
        }

        .like-button:hover {
            background-color: rgba(255, 255, 255, 1);
        }

        .like-button.liked {
            color: #d9534f;
        }

        .like-count {
            margin-left: 5px;
        }

        /* Tanggal Upload */
        .upload-date {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
        }

        /* Tombol Hapus */
        .delete-button {
            position: absolute;
            top: 10px;
            right: 10px;
            color: white;
            background-color: rgba(255, 0, 0, 0.7);
            border-radius: 50%;
            padding: 8px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 14px; /* Perkecil ukuran font */
        }

        .delete-button:hover {
            background-color: rgba(255, 0, 0, 1);
        }

        /* Form Komentar */
        .comment-form {
            display: none;
            position: absolute;
            bottom: 30px;
            left: 10px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            width: 90%;
        }

        .upload-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .upload-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
        }

        .preview-image {
            display: block;
            width: 100%;
            max-width: 100%;
            height: auto;
            margin-top: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-upload {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            background-color: #007bff;
            color: white;
            border: none;
        }

        /* Navigasi */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .profile-btn {
            position: absolute;
            right: 80px;
            top: 10px;
        }

        @media (max-width: 768px) {
            .upload-container {
                padding: 20px;
            }
        }

    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Galeri Foto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <a href="profil.php" class="btn btn-outline-primary m-1">Profil</a>
            <a href="logout.php" class="btn btn-outline-danger m-1">Logout</a>
        </div>
    </div>
</nav>

<div>
    <h3>qwqwq</h3>
</div>
<div class="container-fluid">
    <div class="text-center my-4">
        <h1>UKK Galeri Foto</h1>
        <p class="lead">Selamat datang di galeri kami</p>
    </div>

    <!-- Bagian Formulir Upload -->
    <div class="container mt-5">
        <div class="upload-container">
            <h2>Upload Foto ke Galeri</h2>
            <form action="upload_gallery.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="gallery-title"><i class="fa fa-tag"></i> Judul Foto:</label>
                    <input type="text" class="form-control" id="gallery-title" name="title" placeholder="Masukkan judul foto" required>
                </div>
                <div class="form-group">
                    <label for="photo"><i class="fa fa-camera"></i> Pilih Foto:</label>
                    <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*" onchange="previewImage(event)" required>
                </div>
                <!-- Pratinjau gambar -->
                <img id="preview" class="preview-image" src="#" alt="Pratinjau Foto" style="display:none;">
                <button type="submit" class="btn btn-primary btn-upload mt-3">Upload Foto</button>
            </form>
        </div>
    </div>

    <!-- Galeri Foto -->
    <div class="gallery">
        <?php
        include "database.php";
        $query = mysqli_query($conn, "SELECT * FROM foto_coba");
        while ($data = mysqli_fetch_assoc($query)) {
        ?>
        <div class="grid-item">
            <a href="photo_detail.php?foto_id=<?= $data['FotoID']; ?>">
                <img src="<?= htmlspecialchars($data['LokasiFile']); ?>" alt="<?= htmlspecialchars($data['JudulFoto']); ?>">
            </a>

            <!-- Tombol Hapus Foto -->
            <a href="delete_photo.php?foto_id=<?= $data['FotoID']; ?>" class="delete-button" onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>

            <button class="like-button" onclick="likePhoto(this)">
                <i class="fa fa-heart" aria-hidden="true"></i> <span class="like-count">0</span>
            </button>

            <!-- Tanggal upload -->
            <p class="upload-date"><?= date("d M Y H:i", strtotime($data['TanggalUpload'])); ?></p>

            <!-- Formulir Komentar (Tersembunyi) -->
            <div class="comment-form">
                <textarea class="form-control" placeholder="Tulis komentar..."></textarea>
                <button class="btn btn-primary mt-2">Kirim Komentar</button>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan pratinjau gambar
    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block';
    }

    // Fungsi untuk menangani tombol like
    function likePhoto(button) {
        button.classList.toggle("liked");
        let likeCount = button.querySelector(".like-count");
        let count = parseInt(likeCount.textContent, 10);
        if (button.classList.contains("liked")) {
            count++;
        } else {
            count--;
        }
        likeCount.textContent = count;
    }
</script>

</body>
</html>
