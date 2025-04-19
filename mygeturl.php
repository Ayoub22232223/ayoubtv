<?php

// إعداد بيانات الطلب
$url = "https://yallagoall.com/TOD/WEB/BEIN/bs1.php";
$headers = [
    "Content-Type: application/x-www-form-urlencoded",
    "Referer: https://www.high-kora.com/"
];
$body = ""; // كما هو مطلوب، جسم الطلب فارغ

// تنفيذ الطلب باستخدام cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "خطأ في الاتصال: " . curl_error($ch);
    curl_close($ch);
    exit;
}

curl_close($ch);

// تحليل النتيجة لاستخراج stream_url من جزء: let channelData = {...}
$pattern = '/let channelData = \{.*?"stream_url":"(.*?)"/';

// تنفيذ المطابقة
if (preg_match($pattern, $response, $matches)) {
    $streamUrl = $matches[1];
    echo $streamUrl; // فقط الرابط، بدون نص إضافي
} else {
    echo "لم يتم العثور على stream_url.";
}
?>
