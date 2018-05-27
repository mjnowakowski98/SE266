<?php
    $requireUser = true;
    include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php");
?>

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
                    <a href="/lab6/index.php">Go back</a>
                    <hr>
                </div>

                <?php
                    if($userInfo['admin_id']) $orders = getOrders();
                    else $orders = getOrders($user);

                    if(!$orders) echo "No orders to display";

                    $doc = new DOMDocument();
                    foreach($orders as $order) {
                        $doc->appendChild($doc->createTextNode($order['order_id']));
                        $doc->appendChild($doc->CreateTextNode(" | "));

                        $orderName = $doc->createElement("a");
                        $orderName->setAttribute("href", "/lab6/common/orderdetails.php?orderId=" . $order['order_id']);
                        $custInfo = getUserInfo($order['user_id']);
                        $orderName->appendChild($doc->createTextNode($custInfo['last_name'] . ", " . $custInfo['first_name']));
                        $doc->appendChild($orderName);

                        $doc->appendChild($doc->CreateTextNode(" | "));

                        $doc->appendChild($doc->createElement('br'));
                    }
                    echo $doc->saveHTML();
                ?>
            </section>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        
        </div>
    </body>
</html>