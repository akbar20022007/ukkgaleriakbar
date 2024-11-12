<?php
session_start();
include 'database.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: looin.php");
    exit();
}

// Ambil informasi pengguna dari database
$username = $_SESSION['username'];
$query = $conn->prepare("SELECT * FROM user WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .profile-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .profile-card h4 {
            font-size: 24px;
            color: #333;
        }
        .profile-card p {
            font-size: 16px;
            color: #666;
        }
        .back-button {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
        }
        .back-button:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>  
<div class="container">
    <div class="profile-header">
        <h1>Profil Pengguna</h1>
        <p class="text-muted">Informasi akun Anda</p>
    </div>
    <div class="profile-card">
        <h4><?php echo htmlspecialchars($user['username']); ?></h4>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Bergabung pada:</strong> <?php echo date("d M Y", strtotime($user['created_at'])); ?></p>
    </div>
    <a href="index.php" class="back-button">Kembali ke Galeri</a>
</div>
</body>
</html>
