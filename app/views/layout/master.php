<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/LUXURY_SPORTS/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once './app/views/components/Header.php';
    ?>
    <div id="content">
        <?php
            require_once './app/views/pages/'.$data['Page'].'.view'.'.php';
        ?>
    </div>
    <?php
        require_once './app/views/components/Footer.php';
    ?>
    <script src="/LUXURY_SPORTS/public/js/LoadPage.js"></script>
    <script src="/LUXURY_SPORTS/public/js/Search.js"></script>
    <script src="/LUXURY_SPORTS/public/js/WebSocketClient.js"></script>
</body>
</html>