<?php

namespace App;

use PDO as PDO;

class MysteryGame {
    
    private int $user_id;
    private string $item;
    private PDO $pdo;
    private array $items = [
        'boat' => 0,
        'wolf' => 0,
        'goat' => 0,
        'cabbage' => 0];
    private int $MOVE_NOT_ALLOWED_STATUS = 403;
    private int $ITEM_NOT_EXIST_STATUS = 400;
    private int $GAME_OVER_STATUS = 226;

    public function __construct(int $user_id, string $item, PDO $pdo) {
        $this->user_id = $user_id;
        $this->item = $item;
        $this->pdo = $pdo;
        $stmt = $this->pdo->prepare('SELECT * FROM games WHERE user_id = ?');
        $stmt->execute([$this->user_id]);
        if ($stmt->rowCount() == 0) {
            $this->createGame();
        }
        $this->loadItems();
        $this->updateItems();
        $this->checkFalsePosition();
        $this->saveItems();
    }
    
    private function createGame(): void {      
        $stmt = $this->pdo->prepare('INSERT INTO games (user_id, move, boat, wolf, goat, cabbage) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$this->user_id, 0, 0, 0, 0, 0]);
    }
    
    private function loadItems(): void {
        $stmt = $this->pdo->prepare('SELECT * FROM games WHERE user_id = ?');
        $stmt->execute([$this->user_id]);
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($rows as $name => $value) {
            if (isset($this->items[$name])) {
                $this->items[$name] = $value;
            }
        }
    }
    
    private function updateItems() {
        if (isset($this->items[$this->item])) {
            $this->items[$this->item] = $this->items[$this->item] == 0 ? 1 : 0;
            if ($this->item != 'boat') {
                $this->items['boat'] = $this->items['boat'] == 0 ? 1 : 0;
            }
        } else {
            return exit(http_response_code($this->ITEM_NOT_EXIST_STATUS));
        }
    }
    
    private function checkFalsePosition() {
        if ($this->items['boat'] != $this->items['goat'] && 
                ($this->items['goat'] == $this->items['wolf'] || $this->items['goat'] == $this->items['cabbage'])) {
            return exit(http_response_code($this->MOVE_NOT_ALLOWED_STATUS));
        }
    }
    
    private function saveItems(): void {
        if ($this->item != 'boat') {
            $stmt = $this->pdo->prepare('UPDATE games SET boat = ? WHERE user_id = ?');
            $stmt->execute([$this->items['boat'], $this->user_id]);
        }
        /*
        * $this->item is checked by updateItems() method
        */
        $stmt = $this->pdo->prepare('UPDATE games SET ' . $this->item . ' = ?, move = move + ? WHERE user_id = ?');
        $stmt->execute([$this->items[$this->item], 1, $this->user_id]);
    }
    
    public function checkGameOver() {
        if (array_sum(array_values($this->items)) == 4) {
            $this->updateScore();
            return exit(http_response_code($this->GAME_OVER_STATUS));
        }
    }
    
    private function updateScore(): void {
        $stmt = $this->pdo->prepare('SELECT * FROM games WHERE user_id = ?');
        $stmt->execute([$this->user_id]);
        $moves = $stmt->fetch(PDO::FETCH_ASSOC)['move'];
        $stmt = $this->pdo->prepare('UPDATE users SET score = score + ? WHERE id = ?');
        $stmt->execute([($moves > 7 ? 7 - $moves : $moves), $this->user_id]);
    }
}
