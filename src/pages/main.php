<!DOCTYPE html>
<html>
    <head>
        <title>Mystery</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $_ENV['PATH_IMG']; ?>favicon.ico">
        <link rel="stylesheet" href="<?php echo $_ENV['PATH_CSS']; ?>main.css" />
        <link rel="stylesheet" href="<?php echo $_ENV['PATH_CSS']; ?>game.css" />
        <script src="<?php echo $_ENV['PATH_JS']; ?>main.js"></script>
        <script src="<?php echo $_ENV['PATH_JS']; ?>game.js"></script>
    </head>
    <body>
        <header class="header">
            <div>Welcome, <span class="username"><?php echo $_SESSION['name']; ?></span>!</div>
            <div>
                <button id="new-button" class="header-button" onclick="window.location.reload()">New</button>
                <button class="header-button" onclick="logout()">Out</button>
            </div>
        </header>
        <main>
            <div id="game" class="game">
                <img id="boat" name="boat" src="<?php echo $_ENV['PATH_IMG']; ?>boat.svg" class="items boat" draggable="false"></img>
                <img name="wolf" src="<?php echo $_ENV['PATH_IMG']; ?>wolf.svg" class="items" draggable="false"></img>
                <img name="goat" src="<?php echo $_ENV['PATH_IMG']; ?>goat.svg" class="items" draggable="false"></img>
                <img name="cabbage" src="<?php echo $_ENV['PATH_IMG']; ?>cabbage.svg" class="items" draggable="false"></img>
            </div>
            <div id="board"></div>
        </main>
    </body>
</html>
