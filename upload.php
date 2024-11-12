<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        .gallery-item {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 300px;
        }
        .gallery-item img {
            width: 100%;
            height: auto;
        }
        .gallery-item h3 {
            padding: 10px;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Galeri Foto</h2>
    <div class="gallery">
        <?php
        // Baca data galeri dari file JSON
        $gallery_file = 'gallery.json';
        if (file_exists($gallery_file)) {
            $gallery_data = json_decode(file_get_contents($gallery_file), true);
            foreach ($gallery_data as $item) {
                echo '<div class="gallery-item">';
                echo '<img src="uploads/gallery/' . htmlspecialchars($item['photo']) . '" alt="' . htmlspecialchars($item['title']) . '">';
                echo '<h3>' . htmlspecialchars($item['title']) . '</h3>';
                echo '</div>';
            }
        } else {
            echo '<p>Tidak ada foto dalam galeri.</p>';
        }
        ?>
    </div>

</body>
</html>
        