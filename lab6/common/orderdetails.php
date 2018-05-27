<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's</title>
        <meta charset="UTF-8">
        <link href="/lab6/css/master.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/formparts.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/effects.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/displays.css" type="text/css" rel="stylesheet">
    </head>
    
    <body>
        <div id="background"></div>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>
        
            <section id="content">
                <?php
                    $orderId = filter_input(INPUT_GET, 'orderId', INPUT_VALIDATE_INT) ?? NULL;
                    $orderInfo = getOrderLines($orderId);

                    $doc = new DOMDocument();
                    foreach($orderInfo as $line) {
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