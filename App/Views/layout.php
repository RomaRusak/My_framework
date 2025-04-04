<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ pageTitle }}</title>
    <link rel="stylesheet" href="/App/Assets/css/style.css">
</head>
<body>
    <div class="container">
        {{ require(Templates/header) }}
        <div class="content">
            {{ include(content) }}
        </div>
    </div>
</body>
</html>