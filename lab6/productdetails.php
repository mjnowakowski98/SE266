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
                    $product['description'] = NULL;

                    if(!$product['image']) $product['image'] = "default.png";
                    if(!$product['description']) $product['description'] = "This product has no description";
                ?>

                <div id="left">
                    <h2><?php echo $product['product']; ?></h2>
                    <img src="/lab6/images/<?php echo $product['image']; ?>">
                </div>

                <div id="right">
                    <strong>Price: </strong><p>$<?php echo $product['price']; ?></p>
                    <br>
                    <strong>Description: </strong><p id="desc"><?php echo $product['description']; ?></p>

                    <hr>
                    <form id="cartForm" action="/lab6/cart.php" method="POST">
                        <label>Qty: <input id="qty" type="number" name="qty" value="1"></label>
                        <button type="submit">Add to cart</button>
                    </form>
                </div>
            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </diV>
    </body>
</html>