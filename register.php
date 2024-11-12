<?php
include 'database.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan email ada sebelum mengaksesnya
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    // Validasi bahwa email tidak kosong
    if (empty($email)) {
        echo "<div class='alert alert-danger text-center'>Email tidak boleh kosong.</div>";
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT); // Hash password

        // Cek apakah username atau email sudah terdaftar
        $checkUser = "SELECT * FROM user WHERE username='$username' OR email='$email'";
        $result = $conn->query($checkUser);

        if ($result->num_rows > 0) {
            echo "<div class='alert alert-danger text-center'>Username atau email sudah terdaftar.</div>";
        } else {
            // Simpan pengguna baru
            $sql = "INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email')";
            if ($conn->query($sql) === TRUE) {
                // Tampilkan pesan sukses
                echo "<div class='alert alert-success text-center'>Akun berhasil dibuat. Silakan <a href='looin.php'>Login</a>.</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }
    }
}

$conn->close();
?>

<!-- Form Registrasi -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Galeri Foto</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212; /* Warna latar belakang hitam */
            color: #ffffff; /* Teks berwarna putih */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .container {
            background: rgba(0, 0, 0, 0.8); /* Kontainer dengan transparansi */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 400px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #ff4757; /* Warna judul merah cerah */
        }
        .form-control {
            width: calc(100% - 20px); /* Mengurangi lebar agar lebih simetris */
            padding: 15px;
            margin: 10px 0; /* Jarak antar input */
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2); /* Latar belakang input */
            color: #ffffff;
            font-size: 16px;
            transition: background 0.3s;
            text-align: center; /* Teks di tengah */
        }
        .form-control::placeholder {
            color: #cccccc; /* Placeholder berwarna abu-abu terang */
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.3); /* Latar belakang saat fokus */
            outline: none;
        }
        .btn {
            width: calc(100% - 20px); /* Mengurangi lebar agar lebih simetris */
            padding: 15px;
            background: linear-gradient(135deg, #ff512f, #dd2476); /* Warna tombol */
            color: white;
            transition: 0.3s;
            border: none;
            border-radius: 5px;
            margin-top: 20px; /* Jarak atas tombol */
        }
        .btn:hover {
            background: linear-gradient(135deg, #dd2476, #ff512f); /* Warna tombol saat hover */
        }
        .switch {
            margin-top: 20px;
            font-size: 14px;
        }
        .switch a {
            color: #ffffff; /* Tautan berwarna putih */
            text-decoration: underline;
        }
        .switch a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar di Sini</h2>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </form>
        <div class="switch text-center mt-3">
            <p>Sudah punya akun? <a href="looin.php">Login di sini</a></p>
        </div>
    </div>
</body>
</html>
