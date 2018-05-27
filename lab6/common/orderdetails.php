<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's</title>
        <meta charset="UTF-8">
        
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/mastercsslinks.php"); ?>
        <link href="/lab6/css/displays.css" type="text/css" rel="stylesheet">
    </head>
    
    <body>
        <div id="background"></div>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>
        
            <section id="content">
                <div class="formCenter">
                    <a href="/lab6/common/vieworders.php">Go back</a>
                    <hr>
                </div>
                <h3>Order Items</h3>
                <?php
                    $orderId = filter_input(INPUT_GET, 'orderId', FILTER_VALIDATE_INT) ?? NULL;
                    $orderInfo = getOrderLines($orderId);

                    $doc = new DOMDocument();
                    foreach($orderInfo as $line) { // Output list of products in order
                        $productInfo = getProductInfo($line['product_id']);
                        $productName = $doc->createElement('a');
                        $productName->setAttribute("href", "/lab6/productdetails.php?productId=" . $line['product_id']);
                        $productName->appendChild($doc->createTextNode($productInfo['product']));
                        $doc->appendChild($productName);

                        $doc->appendChild($doc->CreateTextNode(" | "));
                        $doc->appendChild($doc->createTextNode('Qty: ' . $line['qty']));

                        $doc->appendChild($doc->createElement('br'));
                    }
                    echo $doc->saveHTML();
                ?>
            </section>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        
        </div>
    </body>
</html>