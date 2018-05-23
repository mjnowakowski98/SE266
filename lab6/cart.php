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
                                break;
                            }
                        }
                        if(!$inCart) {
                            $cart[] = [
                                'productId' => $productId,
                                'qty' => $qty
                            ];
                        }
                        break;

                    case 'Remove': // item2 named so because item causes issues, thanks php
                        $count = 0;
                        foreach($cart as $item2) {
                            if($item2['productId'] === $productId) {
                                unset($cart[$count]);
                                break;
                            }

                            $count++;
                        }
                        break;

                    case 'Checkout':
                        checkout($cart);
                        break;

                    case 'Clear':
                        $cart = array();
                        $_SESSION['cart'] = NULL;
                        break;

                    default:
                        break;
                }

                $_SESSION['cart'] = $cart;

                session_write_close();
            ?>

            <section id="content">
                <h2>Your Cart</h2>
                <?php
                    $doc = new DOMDocument();
                    foreach($cart as $line) {
                        $productInfo = getProductInfo($line['productId']);
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
                        $priceOut->appendChild($doc->createTextNode('$' . $productInfo['price']));
                        $rightDiv->appendChild($priceOut);

                        $qtyOut = $doc->createElement("p");
                        $qtyOut->appendChild($doc->createTextNode('Qty: ' . $line['qty']));
                        $rightDiv->appendChild($qtyOut);

                        $detailBtn = $doc->createElement("button");
                        $detailBtn->setAttribute("class", "formBtn");
                        $detailBtn->setAttribute("type", "button");
                        $rightDiv->appendChild($detailBtn);

                        $detailLink = $doc->createElement("a");
                        $detailLink->setAttribute("href", "/lab6/productdetails.php?productId=" . $line['productId']);
                        $detailLink->appendChild($doc->createTextNode("Details"));
                        $detailBtn->appendChild($detailLink);

                        $removeBtn = $doc->createElement("button");
                        $removeBtn->setAttribute("class", "formBtn");
                        $removeBtn->setAttribute("type", "button");
                        $rightDiv->appendChild($removeBtn);

                        $removeLink = $doc->createElement("a");
                        $removeLink->setAttribute("href", "?cartAction=Remove&productId=" . $line['productId']);
                        $removeLink->appendChild($doc->createTextNode("Remove"));
                        $removeBtn->appendChild($removeLink);
                    }
                    echo $doc->saveHTML();
                ?>
                <div class="formCenter">
                    <button class="formBtn"><a href="?cartAction=Clear">Clear</a></button>
                    <button class="formBtn"><a href="?cartAction=Checkout">Checkout</a></button>
                </div>

            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </diV>
    </body>
</html>