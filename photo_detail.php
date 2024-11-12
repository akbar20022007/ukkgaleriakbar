<?php
include "database.php";

// Ambil FotoID dari URL
$foto_id = isset($_GET['foto_id']) ? (int) $_GET['foto_id'] : 0;

if ($foto_id > 0) {
    $query = mysqli_query($conn, "SELECT * FROM foto_coba WHERE FotoID = $foto_id");

    if ($query) {
        $foto = mysqli_fetch_assoc($query);
    } else {
        echo "Terjadi kesalahan saat mengambil data foto: " . mysqli_error($conn);
        exit;
    }
} else {
    echo "Foto tidak ditemukan!";
    exit;
}

// Proses pengiriman komentar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message']) && isset($_POST['nama'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Query untuk menyimpan komentar
    $sql_comment = "INSERT INTO komentar1 (foto_id, nama, message) VALUES ('$foto_id', '$nama', '$message')";
    if (mysqli_query($conn, $sql_comment)) {
        echo "<div class='alert alert-success text-center'>Komentar berhasil dikirim.</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Terjadi kesalahan saat mengirim komentar: " . mysqli_error($conn) . "</div>";
    }
}

// Cek apakah ada permintaan untuk menghapus komentar
if (isset($_POST['delete_comment'])) {
    $comment_id = (int) $_POST['comment_id'];  // Ambil ID komentar

    // Query untuk menghapus komentar dari tabel komentar1
    $sql_delete = "DELETE FROM komentar1 WHERE id = $comment_id";
    
    if (mysqli_query($conn, $sql_delete)) {
        echo "<div class='alert alert-success text-center'>Komentar berhasil dihapus.</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Terjadi kesalahan saat menghapus komentar: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Foto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <style>
        /* Gradien untuk latar belakang */
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            font-family: 'Poppins', sans-serif;
        }

        /* Container Detail */
        .container-detail {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        /* Gambar Foto */
        .img-container {
            max-width: 45%;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .img-fluid {
            width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .img-fluid:hover {
            transform: scale(1.05);
        }

        /* Seksi Komentar */
        .comment-section {
            max-width: 50%;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Tombol Komentar */
        .comment-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background-color: #2575fc;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .comment-btn:hover {
            background-color: #6a11cb;
            transform: translateY(-2px);
        }

        /* Formulir Komentar */
        .comment-form {
            display: none;
            margin-top: 20px;
        }

        .comment-form input, .comment-form textarea {
            margin-bottom: 15px;
        }

        .comment-form button {
            width: 100%;
            padding: 12px;
            background-color: #2575fc;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .comment-form button:hover {
            background-color: #6a11cb;
        }

        /* Daftar Komentar */
        .comment-list {
            margin-top: 30px;
        }

        .comment {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .comment:hover {
            background-color: #f1f1f1;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .comment p {
            margin: 0;
        }

        .comment p strong {
            font-weight: bold;
        }

        .comment-time {
            font-size: 12px;
            color: #888;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .container-detail {
                flex-direction: column;
                align-items: center;
            }

            .img-container {
                max-width: 100%;
                margin-bottom: 20px;
            }

            .comment-section {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Website Galeri Foto</a>
        <a href="index.php" class="btn btn-outline-primary m-1">Kembali ke Galeri</a>
    </div>
</nav>

<div class="container my-5 container-detail">
    <!-- Gambar di sebelah kiri -->
    <div class="img-container">
        <h2 class="text-center"><?= htmlspecialchars($foto['JudulFoto']); ?></h2>
        <img src="<?= htmlspecialchars($foto['LokasiFile']); ?>" alt="<?= htmlspecialchars($foto['JudulFoto']); ?>" class="img-fluid">
        <div class="comment-btn" onclick="toggleCommentForm()">Tambah Komentar</div>
    </div>

    <!-- Form komentar di sebelah kanan -->
    <div class="comment-section">
        <div class="comment-form">
            <h4>Tulis Komentar</h4>
            <form action="photo_detail.php?foto_id=<?= $foto_id; ?>" method="POST">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                </div>
                <div class="form-group">
                    <label for="message">Komentar</label>
                    <textarea name="message" class="form-control" rows="3" placeholder="Tulis komentar Anda" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>
        </div>

        <!-- Daftar Komentar -->
        <div class="comment-list">
            <?php
            $sql_comments = "SELECT * FROM komentar1 WHERE foto_id = $foto_id ORDER BY id DESC";
            $result = mysqli_query($conn, $sql_comments);
            if (mysqli_num_rows($result) > 0) {
                while ($comment = mysqli_fetch_assoc($result)):
            ?>
            <div class="comment">
                <p><strong><?= htmlspecialchars($comment['nama']); ?>:</strong></p>
                <p><?= nl2br(htmlspecialchars($comment['message'])); ?></p>
                <p class="comment-time"><?= isset($comment['Tanggal']) ? date("d M Y H:i", strtotime($comment['Tanggal'])) : ''; ?></p>

                <!-- Tombol Hapus -->
                <form method="POST" action="photo_detail.php?foto_id=<?= $foto_id; ?>" style="display:inline;">
                    <button type="button" class="btn btn-link" onclick="toggleDeleteForm(<?= $comment['id']; ?>)">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <div id="delete-form-<?= $comment['id']; ?>" style="display:none;">
                        <input type="hidden" name="comment_id" value="<?= $comment['id']; ?>">
                        <button type="submit" name="delete_comment" class="btn btn-danger btn-sm">Hapus</button>
                    </div>
                </form>
            </div>
            <?php endwhile; } else { ?>
            <div class="alert alert-info">Tidak ada komentar untuk foto ini.</div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan atau menyembunyikan form hapus
    function toggleDeleteForm(commentId) {
        var form = document.getElementById('delete-form-' + commentId);
        form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
    }

    // Fungsi untuk menampilkan form komentar
    function toggleCommentForm() {
        var form = document.querySelector('.comment-form');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }
</script>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
