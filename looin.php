<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Galeri Foto</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            color: #ffffff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 400px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #ff4757;
        }
        input {
            width: calc(100% - 20px);
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-size: 16px;
            transition: background 0.3s;
            text-align: center;
        }
        input::placeholder {
            color: #cccccc;
        }
        input:focus {
            background: rgba(255, 255, 255, 0.2);
            outline: none;
        }
        button {
            width: calc(100% - 20px);
            padding: 15px;
            background: #ff4757;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 18px;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.3s, transform 0.2s;
        }
        button:hover {
            background: #e84118;
            transform: translateY(-2px);
        }
        .switch {
            margin-top: 20px;
            font-size: 14px;
        }
        .switch a {
            color: #ffffff;
            text-decoration: underline;
        }
        .error {
            color: #ff4757;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
    <script>
        // Menampilkan pesan error sebagai pop-up jika ada
        window.onload = function() {
            <?php if (isset($_SESSION['error'])): ?>
                alert("<?php echo $_SESSION['error']; ?>");
                <?php unset($_SESSION['error']); // Hapus pesan error setelah ditampilkan ?>
            <?php endif; ?>
        };
    </script>
</head>
<body>
    <div class="container">
        <h2>Login Galeri Foto</h2>

        <form action="login_process.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <div class="switch">
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
