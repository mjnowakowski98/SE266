<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's</title>
        <meta charset="UTF-8">
        
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/mastercsslinks.php"); ?>
        <link href="/lab6/css/cart.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div id="background"></div>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>

            <?php
                $cart = $_SESSION['cart'] ?? array();
                $productId = filter_input(INPUT_GET, 'productId', FILTER_VALIDATE_INT) ?? NULL;
                $qty = filter_input(INPUT_GET, 'qty', FILTER_VALIDATE_INT) ?? NULL;
                $cartAction = filter_input(INPUT_GET, 'cartAction', FILTER_SANITIZE_STRING) ?? NULL;
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
                        if(!$user) {
                            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/auth.php");
                            break;
                        }
                        checkout($cart, $user);
                        $cart = array();
                        break;

                    case 'Clear':
                        $cart = array();
                        break;

                    default:
                        break;
                }

                var_dump($cart);

                $_SESSION['cart'] = $cart;

                session_write_close();
            ?>

            <section id="content">
                <h2>Your Cart</h2>
                <?php
                    $grossPrice = 0.00;

                    $doc = new DOMDocument();
                    foreach($cart as $line) {
                        $productInfo = getProductInfo($line['productId']);

                        var_dump($productInfo['price']);
                        var_dump($line['qty']);

                        $grossPrice += $productInfo['price'] * $line['qty'];

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
                    var_dump($grossPrice);
                ?>
                <div class="formCenter">
                    <p><strong>Sub-Total:</strong> $<?php echo $grossPrice; ?></p>
                    <p>
                        <strong>Total: </strong>
                        $<?php
                            $totalPrice = round($grossPrice + ($grossPrice * .07), 2);
                            echo $totalPrice;
                        ?>
                    </p>
                </div>
                <div class="formCenter">
                    <button class="formBtn"><a href="?cartAction=Clear">Clear</a></button>
                    <button class="formBtn"><a href="?cartAction=Checkout">Checkout</a></button>
                </div>

            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </diV>
    </body>
</html>