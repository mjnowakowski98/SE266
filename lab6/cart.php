<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's</title>
        <meta charset="UTF-8">
        <link href="/lab6/css/master.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/formparts.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/effects.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/cart.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/formparts.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div id="background"></div>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>

            <section id="content">
                <?php
                    $cart = $_SESSION['cart'] ?? array();
                    $productId = $_GET['productId'] ?? NULL;
                    $qty = $_GET['qty'] ?? NULL;
                    $qty = intval($qty);

                    $cartAction = $_GET['cartAction'] ?? NULL;
                    switch($cartAction) {
                        case 'Add':
                            $inCart = false;
                            foreach($cart as &$item) {
                                if($item['productId'] === $productId) {
                                    $item['qty'] += $qty;
                                    $inCart = true;
                                }
                            }

                            if(!$inCart) {
                                $cart[] = [
                                    'productId' => $productId,
                                    'qty' => $qty
                                ];
                            }
                            $_SESSION['cart'] = $cart;
                            break;
                        case 'Clear':
                            $_SESSION['cart'] = NULL;
                            break;
                        default:
                            break;
                    }
                    
                ?>

                <h2>Shopping Cart</h2>
                <?php
                    $doc = new DOMDocument();

                    $count = 0;
                    foreach($cart as $item) {
                        $productInfo = getProductInfo($item['productId']);
                        if(!$productInfo['image']) $productInfo['image'] = "default.png";

                        $container = $doc->createElement("div");
                        $container->setAttribute("class", "cartLine");
                        $doc->appendChild($container);

                        $leftDiv = $doc->createElement("div");
                        $leftDiv->setAttribute("class", "left");
                        $container->appendChild($leftDiv);

                        $title = $doc->createElement("h4");
                        $title->appendChild($doc->createTextNode($productInfo['product']));
                        $leftDiv->appendChild($title);

                        $img = $doc->createElement("img");
                        $img->setAttribute("src", "/lab6/images/" . $productInfo['image']);
                        $leftDiv->appendChild($img);

                        $rightDiv = $doc->createElement("div");
                        $rightDiv->setAttribute("class", "right");
                        $container->appendChild($rightDiv);

                        $priceOut = $doc->createElement("p");
                        $priceOut->appendChild($doc->createTextNode($productInfo['price']));
                        $rightDiv->appendChild($priceOut);

                        $removeBtn = $doc->createElement("button");
                        $removeBtn->setAttribute("class", "formBtn");
                        $removeBtn->setAttribute("type", "button");
                        $rightDiv->appendChild($removeBtn);

                        $removeLink = $doc->createElement("a");
                        $removeLink->setAttribute("href", "/lab6/cart.php?cartAction=Remove&productId=" . $productInfo['product_id']);
                        $removeLink->appendChild($doc->createTextNode("Remove"));
                        $removeBtn->appendChild($removeLink);

                        if($count && $count < count($cart) - 1)
                            $doc->appendChild($doc->createElement("hr"));

                        $count++;
                    }
                    echo $doc->saveHTML();
                ?>

                <!--<button class="formBtn" type="button"><a href="#">Remove</a></button>-->

            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </diV>
    </body>
</html>