<?php
require_once 'config.php';
require_once 'core.php';

$result = '';
if (isset($_POST['create']))
{
    $name = trim($_POST['name']);
    $header = trim($_POST['header']);
    $message = trim($_POST['message']);

    if (mb_strlen($message) > 5) {
        $sql = 'INSERT INTO `messages`(`name`, `header`, `message`) VALUES (:name, :header, :message)';
        $query = $pdo->prepare($sql);
        $query->execute([':name' => $name, ':header' => $header, ':message' => $message]);
        $result = 'Вы молодец';
    } else {
        $result = 'В сообщении ссылка!';
    }
}

$content = file_get_contents('main.tpl');
$content = str_replace('{messages}', get_messages(), $content);
$content = str_replace('{result}', $result, $content);

$header_footer = file_get_contents('../header_footer.tpl');
$header_footer = str_replace('{content}', $content, $header_footer);
echo $header_footer;