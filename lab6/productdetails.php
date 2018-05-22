<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's</title>
        <meta charset="UTF-8">
        <link href="/lab6/css/master.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/formparts.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/effects.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/productdetails.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>

            <section id="content">
                <?php
                    $product = getProductInfo($_GET['productId']);
                    if(!$product['image']) $product['image'] = "default.png";
                ?>

                <div id="left">
                    <h2><?php echo $product['product']; ?></h2>
                    <img src="/lab6/images/<?php echo $product['image']; ?>">
                </div>

                <div id="right">
                    <strong>Price: <p>$<?php echo $product['price']; ?></p></strong>
                </div>
            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </diV>
    </body>
</html>