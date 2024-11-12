<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UKK Galeri Foto - Timeline</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tooplate-style.css">
    <style>
        body {
            background-color: #f2f3f5;
            font-family: 'Open Sans', sans-serif;
        }

        .tm-timeline-item-title {
            font-weight: bold;
            color: #FF6F61;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .tm-timeline-date {
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            color: white;
            text-align: center;
            border-radius: 10px;
        }

        .tm-timeline-date.tm-bg-pink { background-color: #FF6F61; }
        .tm-timeline-date.tm-bg-green { background-color: #4CAF50; }
        .tm-timeline-date.tm-bg-red { background-color: #F44336; }

        .tm-footer {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            text-align: right;
        }

        .tm-footer p { margin: 0; font-size: 14px; }
        .tm-section-title { color: #FF6F61; font-size: 36px; font-weight: bold; margin-bottom: 20px; }
        .tm-main-content { padding: 20px 40px; }

        .tm-media-img-container {
            position: relative;
        }

        .tm-media-img-container img {
            max-width: 100%;
            height: auto;
            display: block;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .tm-media-img-container:hover img { transform: scale(1.05); }
        .love-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: red;
            display: none; /* Disembunyikan secara default */
        }

        .comment-section { margin-top: 15px; }
        .comments { margin-top: 10px; padding-left: 10px; border-left: 1px solid #ccc; }
        .comments div { margin-bottom: 5px; }

        /* Button Style */
        button.btn-primary {
            background-color: #FF6F61;
            border-color: #FF6F61;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        button.btn-primary:hover {
            background-color: #d4564b;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head> -->

<!-- <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Website Galeri Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link active" href="timeline.php">Timeline</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <div class="d-flex">
                    <a href="logout.php" class="btn btn-outline-primary m-1">Logout</a>
                    <a href="login.html" class="btn btn-outline-primary m-1">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="tm-body">
            <div class="tm-main-content">
                <!-- Timeline Item 1 -->
                <div class="row mb-5">
                    <div class="media tm-flexbox-ie-fix tm-width-ie-fix">
                        <div class="col-md-6 text-center mb-md-0 mb-4">
                            <div class="tm-media-img-container">
                                <div class="tm-timeline-date tm-bg-pink">20 February 2015</div>
                                <img src="img/WhatsApp Image 2024-10-23 at 12.59.07.jpeg" alt="Perayaan ulang tahun ke 8">
                                <i class="fa fa-heart love-icon" onclick="likePhoto(this)"></i>
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-4 tm-flex-center">
                            <div class="tm-about-text tm-flexbox-ie-fix">
                                <h2 class="tm-timeline-item-title">Hari Ulang Tahun ke 8</h2>
                                <p>Main ke kebun binatang Bandung bersama keluarga dan teman-teman terdekat.</p>
                                <button class="btn btn-primary" onclick="likePhoto(this)">Like (<span class="like-count">0</span>)</button>
                                <div class="comment-section mt-3">
                                    <input type="text" class="form-control" placeholder="Tulis komentar..." onkeypress="handleComment(event, this)">
                                    <div class="comments mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- row -->

                <!-- Timeline Item 2 -->
                <div class="row mb-5">
                    <div class="media tm-flexbox-ie-fix tm-width-ie-fix">
                        <div class="col-md-6 text-center mb-md-0 mb-4">
                            <div class="tm-media-img-container">
                                <div class="tm-timeline-date tm-bg-green">20 February 2023</div>
                                <img src="img/WhatsApp Image 2024-10-23 at 12.45.24 (1).jpeg" alt="Ulang Tahun ke 16">
                                <i class="fa fa-heart love-icon" onclick="likePhoto(this)"></i>
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-4 tm-flex-center">
                            <div class="tm-about-text tm-flexbox-ie-fix">
                                <h2 class="tm-timeline-item-title">Hari Ulang Tahun ke 16</h2>
                                <p>Perayaan yang menyenangkan dengan hiking ke Gunung Manglayang.</p>
                                <button class="btn btn-primary" onclick="likePhoto(this)">Like (<span class="like-count">0</span>)</button>
                                <div class="comment-section mt-3">
                                    <input type="text" class="form-control" placeholder="Tulis komentar..." onkeypress="handleComment(event, this)">
                                    <div class="comments mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- row -->

                <!-- Timeline Item 3 -->
                <div class="row mb-5">
                    <div class="media tm-flexbox-ie-fix tm-width-ie-fix">
                        <div class="col-md-6 text-center mb-md-0 mb-4">
                            <div class="tm-media-img-container">
                                <div class="tm-timeline-date tm-bg-red">20 February 2024</div>
                                <img src="img/WhatsApp Image 2024-10-23 at 13.08.36.jpeg" alt="Ulang Tahun ke 17">
                                <i class="fa fa-heart love-icon" onclick="likePhoto(this)"></i>
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-4 tm-flex-center">
                            <div class="tm-about-text tm-flexbox-ie-fix">
                                <h2 class="tm-timeline-item-title">Hari Ulang Tahun ke 17</h2>
                                <p>Merayakan ulang tahun di rumah dengan keluarga.</p>
                                <button class="btn btn-primary" onclick="likePhoto(this)">Like (<span class="like-count">0</span>)</button>
                                <div class="comment-section mt-3">
                                    <input type="text" class="form-control" placeholder="Tulis komentar..." onkeypress="handleComment(event, this)">
                                    <div class="comments mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- row -->
            </div>
        </div>

        <footer class="tm-footer">
            <p>UKK &copy; <span class="tm-current-year">2014</span> Akbar Rizki Wiji Maulana XII PPLG 1</p>
        </footer>
    </div>

    <script src="js/jquery-1.11.3.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tm-current-year').text(new Date().getFullYear());
        });

        function likePhoto(button) {
            const likeCountSpan = button.querySelector('.like-count');
            const loveIcon = button.parentElement.querySelector('.love-icon');
            let currentCount = parseInt(likeCountSpan.textContent);

            if (currentCount === 0) { // Jika belum ada like, izinkan like
                currentCount++;
                likeCountSpan.textContent = currentCount;
                loveIcon.style.display = 'block'; // Tampilkan ikon love
            }
        }

        function handleComment(event, input) {
            if (event.key === 'Enter') {
                const commentText = input.value;
                if (commentText) {
                    const commentsDiv = input.nextElementSibling;
                    const commentElement = document.createElement('div');
                    commentElement.textContent = commentText;
                    commentsDiv.appendChild(commentElement);
                    input.value = '';
                }
            }
        }
    </script>
</body>
</html> -->
