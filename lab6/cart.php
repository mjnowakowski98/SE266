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
                $msg = array(); // Used to output to msgbox on include

                // Setup cart
                $cart = $_SESSION['cart'] ?? array(); // Use existing cart if exists
                $productId = filter_input(INPUT_GET, 'productId', FILTER_VALIDATE_INT) ?? NULL;
                $qty = filter_input(INPUT_GET, 'qty', FILTER_VALIDATE_INT) ?? NULL;
                $cartAction = filter_input(INPUT_GET, 'cartAction', FILTER_SANITIZE_STRING) ?? NULL;
                switch($cartAction) {
                    case 'Add':
                        // Loop through cart, update specific product if already exists
                        $inCart = false;
                        foreach($cart as &$item) {
                            if($item['productId'] === $productId) {
                                $item['qty'] += $qty;
                                $inCart = true;
                                break;
                            }
                        }
                        if(!$inCart) { // Otherwise add a new entry
                            $price = getProductInfo($productId)['price'];
                            $cart[] = [
                                'productId' => $productId,
                                'qty' => $qty,
                                'price' => $price
                            ];
                        }
                        break;

                    case 'Remove': // item2 named so because item causes issues, probably to do with one being a reference
                        $count = 0; // Remove if already exists
                        foreach($cart as $item2) {
                            if($item2['productId'] === $productId) {
                                unset($cart[$count]);
                                break;
                            }

                            $count++;
                        }
                        break;

                    case 'Checkout':
                        if(!$user) { // Force user to sign in if they are not
                            include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/auth.php");
                            break;
                        }

                        // Display error if cart is empty
                        if($cart) $count = checkout($cart, $user);
                        else $msg[] = "Error: Nothing to checkout";

                        $cart = array(); // Empty cart, payment details and shipping would go here on a real store
                        break;

                    case 'Clear':
                        $cart = array(); // Empty (reinitialize) cart
                        break;

                    case 'updateQty': // Update qty on existing product
                        foreach($cart as &$item) {
                            if($item['productId'] === $productId) {
                                $newQty = filter_input(INPUT_GET, 'newQty', FILTER_VALIDATE_INT);

                                // No going below zero
                                if($newQty > 0) $item['qty'] = $newQty;
                                else $item['qty'] = 1;

                                $msg[] = "Successfully updated"; // Add a msg to output
                                break;
                            }
                        }
                        break;

                    default:
                        break;
                }

                // If any messages are registered, output to a page contained 'pop-up'
                if($msg) include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/msgbox.php");

                // Store existing cart in session
                $_SESSION['cart'] = $cart;
                session_write_close(); // Close session, otherwise write locking occurs and items get overwritten/unsaved
            ?>

            <section id="content">
                <h2>Your Cart</h2>
                <?php
                    $grossPrice = 0.00; // Start tracking product prices

                    $doc = new DOMDocument();
                    foreach($cart as $line) { // Create dynamic cart lines on page
                        $productInfo = getProductInfo($line['productId']);

                        $grossPrice += $productInfo['price'] * $line['qty']; // Add to gross price

                        if(!$productInfo['image']) $productInfo['image'] = "default.png";

                        // cartLine div
                        $container = $doc->createElement("div");
                        $container->setAttribute("class", "cartLine");
                        $doc->appendChild($container);

                        // cartLine div left section
                        $leftDiv = $doc->createElement("div");
                        $leftDiv->setAttribute("class", "left");
                        $container->appendChild($leftDiv);

                        // Product name
                        $title = $doc->createElement("h4");
                        $title->appendChild($doc->createTextNode($productInfo['product']));
                        $leftDiv->appendChild($title);

                        // Product image
                        $img = $doc->createElement("img");
                        $img->setAttribute("src", "/lab6/images/" . $productInfo['image']);
                        $leftDiv->appendChild($img);

                        // cartLine div right section
                        $rightDiv = $doc->createElement("div");
                        $rightDiv->setAttribute("class", "right");
                        $container->appendChild($rightDiv);

                        // Output price per each
                        $priceOut = $doc->createElement("p");
                        $priceOut->appendChild($doc->createTextNode('$' . $productInfo['price'] . "/ea"));
                        $rightDiv->appendChild($priceOut);

                        // Form to control qty
                        $qtyOut = $doc->createElement("form");
                        $qtyOut->setAttribute("action",'#');
                        $qtyOut->setAttribute("method", "GET");
                        $qtyOut->appendChild($doc->createTextNode('Qty: '));
                        $rightDiv->appendChild($qtyOut);

                        // Qty input
                        $qtyAdjust = $doc->createElement("input");
                        $qtyAdjust->setAttribute("class", "qtySelect");
                        $qtyAdjust->setAttribute("type", "number");
                        $qtyAdjust->setAttribute("name", "newQty");
                        $qtyAdjust->setAttribute("value", $line['qty']);
                        $qtyOut->appendChild($qtyAdjust);

                        // Product id to update
                        $qtyProduct = $doc->createElement("input");
                        $qtyProduct->setAttribute("type", "hidden");
                        $qtyProduct->setAttribute("name", "productId");
                        $qtyProduct->setAttribute("value", $line['productId']);
                        $qtyOut->appendChild($qtyProduct);

                        // cartAction=updateQty
                        $qtyAction = $doc->createElement("input");
                        $qtyAction->setAttribute("type", "hidden");
                        $qtyAction->setAttribute("name", "cartAction");
                        $qtyAction->setAttribute("value", "updateQty");
                        $qtyOut->appendChild($qtyAction);

                        // Submit button
                        $qtySubmit = $doc->createElement("input");
                        $qtySubmit->setAttribute("type", "submit");
                        $qtyOut->appendChild($qtySubmit);

                        // Spacing
                        $rightDiv->appendChild($doc->createElement("br"));

                        // View product details
                        $detailBtn = $doc->createElement("button");
                        $detailBtn->setAttribute("class", "formBtn");
                        $detailBtn->setAttribute("type", "button");
                        $rightDiv->appendChild($detailBtn);

                        // Link to above
                        $detailLink = $doc->createElement("a");
                        $detailLink->setAttribute("href", "/lab6/productdetails.php?productId=" . $line['productId']);
                        $detailLink->appendChild($doc->createTextNode("Details"));
                        $detailBtn->appendChild($detailLink);

                        // Remove item from cart
                        $removeBtn = $doc->createElement("button");
                        $removeBtn->setAttribute("class", "formBtn");
                        $removeBtn->setAttribute("type", "button");
                        $rightDiv->appendChild($removeBtn);

                        // Link to above
                        $removeLink = $doc->createElement("a");
                        $removeLink->setAttribute("href", "?cartAction=Remove&productId=" . $line['productId']);
                        $removeLink->appendChild($doc->createTextNode("Remove"));
                        $removeBtn->appendChild($removeLink);
                    }
                    echo $doc->saveHTML();
                ?>

                <div class="formCenter">
                    <p><strong>Sub-Total:</strong> $<?php echo $grossPrice; ?></p>
                    <p>
                        <strong>Total: </strong>
                        $<?php // Calculate that RI tax (7%)
                            $totalPrice = round($grossPrice + ($grossPrice * .07), 2);
                            echo $totalPrice;
                        ?>
                    </p>
                </div>

                <!-- Checkout/clear buttons -->
                <div class="formCenter">
                    <button class="formBtn"><a href="?cartAction=Clear">Clear</a></button>
                    <button class="formBtn"><a href="?cartAction=Checkout">Checkout</a></button>
                </div>

            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </diV>
    </body>
</html>