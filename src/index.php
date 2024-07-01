<?php
// Get system information
$systemInfo = php_uname();

// Get docker-compose service names
$dockerComposeServices = [
    'apache',
    'mariadb',
    'phpmyadmin'
];

// Get container states
$dockerContainers = [];
foreach ($dockerComposeServices as $service) {
    $status = '';
    exec("docker inspect -f '{{.State.Status}}' {$service}", $status);
    $dockerContainers[$service] = $status[0];
}

// Define service links
$serviceLinks = [
    'Web Application' => '/',
    'phpMyAdmin' => '/phpmyadmin'
];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Docker PHP Environment</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: auto; padding: 20px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Docker PHP Environment</h1>
        
        <h2>System Information</h2>
        <p><?php echo $systemInfo; ?></p>

        <h2>Container States</h2>
        <table>
            <thead>
                <tr>
                    <th>Container Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dockerContainers as $name => $status): ?>
                <tr>
                    <td><?php echo htmlspecialchars($name); ?></td>
                    <td><?php echo htmlspecialchars($status); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Service Links</h2>
        <ul>
            <?php foreach ($serviceLinks as $name => $link): ?>
            <li><a href="<?php echo htmlspecialchars($link); ?>" target="_blank"><?php echo htmlspecialchars($name); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
