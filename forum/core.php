<?php
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
    exit;
}


$sql = 'CREATE TABLE IF NOT EXISTS `messages` (`id` int NOT NULL AUTO_INCREMENT,`name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,`header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,`message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;';
$query = $pdo->query($sql);

function get_messages() {
    global $pdo;
    $sql = 'SELECT * FROM `messages`';
    $query = $pdo->query($sql);

    $tpl = '';
    while ($row = $query->fetch(PDO::FETCH_OBJ)) {
        $tpl .= file_get_contents('answer.tpl');
        $tpl = str_replace('{message}', $row->message, $tpl);
        $tpl = str_replace('{header}', $row->header, $tpl);
        $tpl = str_replace('{name}', $row->name, $tpl);
    }

    if ($tpl == '')
        $tpl = '<h3 class="centerH3">Nothing here(</h3>';

    return $tpl;
}