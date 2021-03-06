<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's</title>
        <meta charset="UTF-8">
        
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/mastercsslinks.php"); ?>
        <link href="/lab6/css/productdetails.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div id="background"></div>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>

            <section id="content">
                <?php // Getr product information
                    $productId = filter_input(INPUT_GET, 'productId', FILTER_VALIDATE_INT) ?? NULL;
                    $product = getProductInfo($productId);
                    $product['description'] = NULL; // Ran out of time to implement product descriptions, always uses default

                    // Replace image/description with default if not specified
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
                    <form id="cartForm" action="/lab6/cart.php" method="GET">
                        <input type="hidden" name="cartAction" value="Add">
                        <input type="hidden" name="productId" value="<?php echo $product['product_id']; ?>">
                        <label>Qty: <input id="qty" type="number" name="qty" value="1"></label>
                        <button type="submit">Add to cart</button>
                    </form>
                </div>
            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </diV>
    </body>
</html>