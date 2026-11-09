<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="src/icons/favicon.webp" type="image/x-icon">
    <link rel="stylesheet" href="styles/output.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Sabrina Carpenter - Home</title>
</head>
<body class="home-page">
    <header class="main-header">
        <?php
            include 'layouts/navbar.php';
        ?>
    </header>
    <main class="page-content">
        <h1 id="h1-title">Sabrina Carpenter</h1>
        <h2 id="h2-title">"Man´s Best Friend" Out Now</h2>
        <p class="hero-p">Stream Now!</p>
            <a href="album.html" class="button-play-preview">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-play-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z"/>
                </svg>
            </a> 
    </main>
    <?php
        include 'layouts/footer.php';
    ?>

    
    <script src="js/navigation.js"></script>
</body>
</html>
