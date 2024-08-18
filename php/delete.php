<?php
$id = "";

$id = $_GET['id'];

$ch = curl_init();
$url = "https://3partssystem-enskilda-projektet.vercel.app/delete/$id";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
header('Location: /');
exit();
?>
