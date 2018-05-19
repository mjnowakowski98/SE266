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
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/header.php"); ?>

            <section id="content">
                <form id="pageControls" action="#" method="get">
                    <label>Search/sort controls (NYI): <input type="text"></label>
                    <input type="submit">
                </form>

                <section class="displayRow">
                    <?php
                        $productList = getProductList();

                        $doc = new DOMDocument();

                        for($i = 0; $i < 13; $i++) {

                        foreach($productList as $product) {
                            $newDisplay = $doc->createElement("div");
                            $newDisplay->setAttribute("class", "productDisplay");
                            $doc->appendChild($newDisplay);

                            $img = $doc->createElement("img");
                            if(!$product['image'])
                                $img->setAttribute("src", "/lab6/images/default.png");
                            else $img->setAttribute("src", "/lab6/images/" . $product['image']);

                            $newDisplay->appendChild($img);

                            $newTitle = $doc->createElement("p");
                            $newTitle->appendChild($doc->createTextNode($product['product']));
                            $newDisplay->appendChild($newTitle);
                        }

                        }

                        echo $doc->saveHTML();
                    ?>
                </section>
            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/footer.php"); ?>
        </div>
    </body>
</html>