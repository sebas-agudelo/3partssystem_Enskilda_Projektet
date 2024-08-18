<?php
require_once './Layout/navbar.php';
require_once './Layout/head.php';
$title = "";
$price = "";
$errTitle = "";
$errPrice = "";
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];

    $ch = curl_init();
    $url = "https://3partssystem-enskilda-projektet.vercel.app/post";

    $newProduct = [
        "title" => $title,
        "price" => $price,
    ];

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($newProduct));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $result = json_decode($response, true);
    curl_close($ch);

    if(empty($title) || empty($price)){
        $errTitle = "Fältet är obligatorisk";
        $errPrice = "Fältet är obligatorisk";
    }

    if (isset($result["error"])) {
        $message = $result["error"];
    } else {
        header('Location: /');
        exit();
    }
    
}

ob_start();
_head("Lägg till produkt - Butiken")

?>

<?php _navbar() ?>

<body>
    
    <h3 class="ServerErrors"><?php echo $message?></h3>
  
    <div class="form-container">
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Titel" value="<?php echo $title?>">
            <span><?php echo $errTitle?></span>

            <input type="text" name="price" placeholder="Priset">
            <span><?php echo $errPrice?></span>

            <div class="add-btn-container">
                <button type="submit">Lägg till</button>
            </div>
        </form>
    </div>
</body>



<?php
ob_end_flush();
?>