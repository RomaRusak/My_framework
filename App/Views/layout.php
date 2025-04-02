<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <?php require_once __DIR__ . '/Templates/header.php'?>
        <div class="content">
            <?php require_once __DIR__ . "/Templates/$content.php" ?>
        </div>
    </div>
</body>
</html>