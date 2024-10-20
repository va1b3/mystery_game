<?php

isset($_SERVER['HTTP_X_REQUESTED_WITH']) ?: exit(http_response_code(404));

require_once __DIR__ . '/../config.php'; ?>


<table class="board-table">
    <caption class="board-caption">TOP-10</caption>
    <thead class="board-head">
        <tr>
            <th>Name</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        <?php $stmt = $pdo->prepare('SELECT *FROM users 
            ORDER BY CASE WHEN score = 0 THEN 1 ELSE 0 END, score DESC LIMIT 10');
        $stmt->execute([]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td class="<?php if ($row['name'] == $_SESSION['name']) { echo "username"; } ?>">
                    <?php echo $row['name']; ?>
                </td>
                <td><?php echo $row['score']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
