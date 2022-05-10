<?php

require __DIR__ . '/../bootstrap.php';

$chat = new QF\Core\Chat;


$message = QF\Core\Util::escape($_POST['message']);
$userId = QF\Core\Util::escape($_POST['incoming_id']);

/*if (empty($message)) {
    return;
}*/

$newChat = $chat->create([
    'user_id' => $userId,
    'content' => $message,
    'create_date' => time(),
]);
