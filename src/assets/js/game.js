/*
 * Only a visual display of the game
 * Calculations take place on the server
 */
document.addEventListener('DOMContentLoaded', function () {
    updateBoard();
    ajaxGetRequest("src/Ajax/AjaxNewGame.php");
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
    element.classList.toggle('item-hidden');
    setTimeout(function() {
        element.classList.toggle('item-hidden');
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
        if (items[i].classList.contains('item-blocked')) {
            items[i].classList.remove('item-blocked');
        }
    }
}

function gameOver() {
    let game = document.getElementById('game'),
        items = game.getElementsByClassName('items');
    setTimeout(function() {
        for (let i = 0; i < items.length; i++) {
            items[i].classList.toggle('item-hidden');
        }
        game.classList.toggle('game-end');
        document.getElementById('new-button').classList.toggle('new-game-button');
    }, 2000);
}

function updateBoard() {
    ajaxGetRequest("src/Ajax/AjaxBoard.php").onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('board').innerHTML = this.responseText;
        }
    };
}

