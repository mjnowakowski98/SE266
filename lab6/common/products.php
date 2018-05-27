<form id="pageControls" action="#" method="GET">
    <label>Category: 
        <select name="catId">
            <option selected>All</option>>
            <?php // Category filter select
                $catId = filter_input(INPUT_GET, 'catId', FILTER_SANITIZE_STRING) ?? 'All';
                if($catId !== 'All') $catId = intval($catId);

                $categories = getCategories();
                $doc = new DOMDocument();
                foreach($categories as $cat) {
                    $option = $doc->createElement("option");
                    $option->setAttribute("value", $cat['category_id']);
                    if($catId == $cat['category_id']) $option->setAttribute("selected", "true");
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
    <?php // Output list of products
        if($catId === 'All') $productList = getProductList();
        else $productList = getProductsByCategory($catId);
        $doc = new DOMDocument();
        foreach($productList as $product) {
            $displayLink = $doc->createElement("a");
            if(!$adminSender)
                $displayLink->setAttribute("href", "/lab6/productdetails.php?productId=" . $product['product_id']);
            else $displayLink->setAttribute("href", "/lab6/admin/productdetails.php?productId=" . $product['product_id']);
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