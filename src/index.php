<?php
// Define service links
$serviceLinks = [
    'Web Application' => '/',
    'phpMyAdmin' => '/phpmyadmin/',
    'phpinfo' => '/phpinfo.php'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAMP - Docker-based XAMPP Alternative</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>DAMP</h1>
        <p class="subtitle">Docker-based Apache, MySQL, and PHP Environment</p>
        <h2>Service Links</h2>
        <ul class="service-links">
            <?php foreach ($serviceLinks as $name => $link): ?>
                <li><a href="<?php echo htmlspecialchars($link); ?>" target="_blank"><?php echo htmlspecialchars($name); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <footer>
        <p>PHP Version: <?php echo phpversion(); ?></p>
    </footer>
</body>
</html>
