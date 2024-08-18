<?php
$fileName = "PRODUCTS.csv";
header("Content-Disposition: attachment; filename=\"$fileName\"");
header('Content-Type: text/csv; charset=utf-8');

$output = fopen('php://output', 'w');

fputcsv($output, array('ID', 'Title', 'Price', 'Image'), ';');

$ch = curl_init();
$url = "https://projektet-3portssystem-dbun.vercel.app/";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
curl_close($ch);

$products = json_decode($response, true);


    foreach ($products as $product) {
        fputcsv($output, $product, ';');
    }


fclose($output);
exit();
?>
