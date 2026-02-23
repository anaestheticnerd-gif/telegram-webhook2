<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(200);
  echo "OK";
  exit;
}

$payload = file_get_contents("php://input");
$shared_secret = '12345';

$ch = curl_init("https://khmiexam.gt.tc/api_bot_webhook_dispatch.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Content-Type: application/json",
  "X-Proxy-Secret: $shared_secret"
]);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
curl_setopt($ch, CURLOPT_TIMEOUT, 6);
curl_exec($ch);
curl_close($ch);

http_response_code(200);
echo "OK";
