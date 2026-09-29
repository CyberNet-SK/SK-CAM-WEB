<?php
// Render Environment Variable থেকে টোকেন ও চ্যাট আইডি নিন
$botToken = getenv('BOT_TOKEN');
$chatId   = getenv('CHAT_ID');

// আপনার Render অ্যাপের ডোমেইন (Render ড্যাশবোর্ড থেকে কপি করে বসান)
$renderDomain = "https://sk-cam-web.onrender.com";

$update = json_decode(file_get_contents('php://input'), true);
$message = $update['message']['text'] ?? '';
$from_id = $update['message']['chat']['id'] ?? '';

if ($message == '/link' && $from_id == $chatId) {
    $reply = "🔗 আপনার লিংক:\n" . $renderDomain . "/index.php";
    @file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($reply));
}
?>
