<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $_ENV['PATH_IMG']; ?>favicon.ico">
        <link rel="stylesheet" href="<?php echo $_ENV['PATH_CSS']; ?>main.css" />
        <script src="<?php echo $_ENV['PATH_JS']; ?>main.js"></script>
    </head>
    <body>
        <header class="header">
            <div>Mystery Game...</div>
        </header>
        <main>
            <div class="login-form">
                <div>Login</div>
                <input id="name" placeholder="Username" type="text" maxlength="15"/>
                <button onclick="login()" class="login-button">Go!</button>
            </div>
        </main>
    </body>
</html>
