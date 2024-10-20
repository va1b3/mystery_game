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
                <button id="new-button" class="header-button" onclick="newGame()">New</button>
                <button class="header-button" onclick="logout()">Out</button>
            </div>
        </header>
        <main>
            <div id="game" class="game">
                <img id="boat" name="boat" class="items boat" draggable="false" 
                     src="<?php echo $_ENV['PATH_IMG']; ?>boat.svg"></img>
                <img name="wolf" class="items" draggable="false" 
                     src="<?php echo $_ENV['PATH_IMG']; ?>wolf.svg"></img>
                <img name="goat" class="items" draggable="false" 
                     src="<?php echo $_ENV['PATH_IMG']; ?>goat.svg"></img>
                <img name="cabbage" class="items" draggable="false" 
                     src="<?php echo $_ENV['PATH_IMG']; ?>cabbage.svg"></img>
            </div>
            <div id="board"></div>
        </main>
        <loader>
            <div class="loader">Loading...</div>
        </loader>
    </body>
</html>
