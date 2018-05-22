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
                <form id="pageControls" action="#" method="GET">
                    <label>Category: 
                        <select name="catId">
                            <option selected>All</option>>
                            <?php
                                $catId = $_GET['catId'] ?? 'All';

                                $categories = getCategories();

                                $doc = new DOMDocument();
                                foreach($categories as $cat) {
                                    $option = $doc->createElement("option");
                                    $option->setAttribute("value", $cat['category_id']);
                                    if($catId === $cat['category_id']) $option->setAttribute("selected", "true");
                                    $option->appendChild($doc->createTextNode($cat['category']));
                                    $doc->appendChild($option);
                                }
                                echo $doc->saveHTML();
                            ?>
                        </select>
                    </label>
                    <input type="submit">
                </form>

                <section class="displayRow">
                    <?php
                        if($catId === 'All') $productList = getProductList();
                        else $productList = getProductsByCategory($catId);

                        $doc = new DOMDocument();
                        foreach($productList as $product) {
                            $displayLink = $doc->createElement("a");
                            $displayLink->setAttribute("href", "/lab6/productdetails.php?productId=" . $product['product_id']);
                            $doc->appendChild($displayLink);

                            $display = $doc->createElement("div");
                            $display->setAttribute("class", "productDisplay");
                            $displayLink->appendChild($display);

                            $img = $doc->createElement("img");
                            if(!$product['image'])
                                $img->setAttribute("src", "/lab6/images/default.png");
                            else $img->setAttribute("src", "/lab6/images/" . $product['image']);

                            $display->appendChild($img);

                            $display->appendChild($doc->createElement("hr"));

                            $newTitle = $doc->createElement("p");
                            $newTitle->appendChild($doc->createTextNode($product['product']));
                            $display->appendChild($newTitle);
                        }
                        echo $doc->saveHTML();
                    ?>
                </section>
            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </div>
    </body>
</html>