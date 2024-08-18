<?php
require_once './Layout/navbar.php';
require_once './Layout/head.php';

$ch = curl_init();
$url = "https://projektet-3portssystem-dbun.vercel.app/";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$result = json_decode($response);
curl_close($ch);

_head('Butiken')
    ?>
<?php _navbar() ?>

<body>
    <section class="products-container">
        <?php
        foreach ($result as $products) { ?>
            <div class="products-wrapper">
                <h4><?php echo $products->title ?></h4>
                <h4><?php echo $products->price ?> kr</h4>

                <div class="btns-container">
                    <button type="submit"><a href="/update.php?id=<?php echo $products->_id ?>"><i
                                class="bi bi-pencil-square"></i></a></button>
                    <button type="submit"><a href="/delete.php?id=<?php echo $products->_id ?>"><i
                                class="bi bi-trash3"></i></a></button>
                </div>
            </div>
            <?php
        } ?>
    </section>
</body>