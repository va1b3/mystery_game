/*
 * Bootloader if there are performance problems
 */
setTimeout(function() {
    document.getElementsByTagName('loader')[0].style.display = 'none';
    document.getElementsByTagName('main')[0].style.opacity = '1';
}, 3000);

/*
 * Only visual part of the game
 * Calculations take place on the server
 */
document.addEventListener('DOMContentLoaded', function () {
    newGame();
    updateBoard();
    document.getElementById('game').addEventListener('click', function(event) {
        if (event.target.classList.contains('items')) {
            ajaxGetRequest("src/Ajax/AjaxGame.php?item=" + event.target.name).onload = function() {
                if (this.readyState === 4 && (this.status === 200 || this.status === 226)) {
                    if (event.target.name !== 'boat') {
                        moveItem(event.target);
                    }
                    moveBoat();
                    unblockItems();
                    if (this.status === 226) {
                        updateBoard();
                        gameOver();
                    }
                } else if (this.readyState === 4) {
                    blockItem(event.target);
                }
            };
        }
    });
});

function moveItem(element) {
    element.classList.add('item-hidden');
    setTimeout(function() {
        element.classList.remove('item-hidden');
        element.classList.toggle('item-floated');
    }, 800);
}

function moveBoat() {
    document.getElementById('boat').classList.toggle('boat-floated');
}

function blockItem(element) {
    element.classList.add('item-blocked');
}

function unblockItems() {
    let items = document.getElementById('game').getElementsByClassName('items');
    for (let i = 0; i < items.length; i++) {
        items[i].classList.remove('item-blocked');
    }
}

function gameOver() {
    let game = document.getElementById('game'),
        items = game.getElementsByClassName('items');
    setTimeout(function() {
        for (let i = 0; i < items.length; i++) {
            items[i].classList.add('item-hidden');
        }
        game.classList.add('game-end');
        document.getElementById('new-button').classList.add('new-game-button');
    }, 2000);
}

function newGame() {
    ajaxGetRequest("src/Ajax/AjaxNewGame.php");
    let game = document.getElementById('game'),
        items = game.getElementsByClassName('items');
    for (let i = 0; i < items.length; i++) {
        items[i].classList.remove('item-hidden');
        items[i].classList.remove('item-floated');
    }
    game.classList.remove('game-end');
    document.getElementById('boat').classList.remove('boat-floated');
    document.getElementById('new-button').classList.remove('new-game-button');
    unblockItems();
}

function updateBoard() {
    ajaxGetRequest("src/Ajax/AjaxBoard.php").onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('board').innerHTML = this.responseText;
        }
    };
}
