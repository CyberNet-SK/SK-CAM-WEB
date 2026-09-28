<?php
$botToken = "YOUR_BOT_TOKEN";
$chatId   = "YOUR_CHAT_ID";

$update = json_decode(file_get_contents('php://input'), true);
$message = $update['message']['text'] ?? '';
$from_id = $update['message']['chat']['id'] ?? '';

if ($message == '/link' && $from_id == $chatId) {
    // Render-এর নিজের ডোমেইন
    $renderDomain = "https://your-app.onrender.com";
    $reply = "🔗 আপনার লিংক:\n" . $renderDomain . "/index.php";

    @file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($reply));
}
?>