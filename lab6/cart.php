<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's</title>
        <meta charset="UTF-8">
        <link href="/lab6/css/master.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/formparts.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/effects.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div id="background"></div>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>

            <section id="content">
                <?php
                    $cart = $_SESSION['cart'] ?? array(); var_dump($_SESSION['cart']);
                    $productId = $_GET['productId'] ?? NULL;
                    $qty = $_GET['qty'] ?? NULL;
                    $qty = intval($qty);

                    $cartAction = $_GET['cartAction'] ?? NULL;
                    switch($cartAction) {
                        case 'Add':
                            $inCart = false;
                            foreach($cart as $item) {
                                //var_dump($item);
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
                        default:
                            break;
                    }
                    
                ?>

                <h2>Shopping Cart</h2>
                <?php var_dump($_SESSION['cart']); ?>

            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </diV>
    </body>
</html>