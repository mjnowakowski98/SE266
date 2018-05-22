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
                            $count = 0;
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
                    /*$doc = new DOMDocument();
                    foreach($car as $item) {
                        $doc->createElement();
                    }
                    echo $doc->saveHTML();*/
                ?>

                <div class="cartLine">
                    <div class="left">
                        <h4>TestLine</h4>
                        <img src="/lab6/images/default.png">
                    </div>
                    <div class="right">
                        <p>Test</p>
                        <p>Test2</p>
                    </div>
                </div>

            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </diV>
    </body>
</html>