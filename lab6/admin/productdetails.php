<?php
    $isAdminPage = true;
    include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's Admin Panel</title>
        <meta charset="UTF-8">

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/mastercsslinks.php"); ?>
        <link href="/lab6/css/productdetails.css" type="text/css" rel="stylesheet">
    </head>
    
    <body>
        <div id="background"></div>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>

            <?php
                $msg = array();

                $productId = filter_input(INPUT_GET, 'productId', FILTER_VALIDATE_INT) ??
                    filter_input(INPUT_POST, 'productId', FILTER_VALIDATE_INT) ?? NULL;

                $prodAction = filter_input(INPUT_POST, 'prodAction', FILTER_SANITIZE_STRING) ?? NULL;
                switch($prodAction) {
                    case 'Update':
                        $newName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING) ?? NULL;
                        $newPrice = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT) ?? NULL;
                        //$newDesc = $_POST['description'];
                        $newCatId = filter_input(INPUT_POST, 'catId', FILTER_VALIDATE_INT) ?? NULL;
                        $newImage = filter_input(INPUT_POST, 'prevImage', FILTER_SANITIZE_STRING) ?? NULL;

                        $imageFile = $_FILES['image'] ?? NULL;
                        if($imageFile['size']) {
                            $errors = array();
                            $fileName = $imageFile['name'];
                            $fileSize = $imageFile['size'];
                            $fileTmp = $imageFile['tmp_name'];
                            $fileType = $imageFile['type'];
                            $fileExt = strtolower(end(explode('.',$_FILES['image']['name'])));
                        
                            $extensions = array("jpeg", "jpg", "png");
                            if(!in_array($fileExt, $extensions))
                                $errors[] = 'File extension not supported, must be JPG or PNG';
                        
                            if($fileSize > 2097152)
                                $errors[] = 'File size must not exceed 2MB';
                        
                            if(empty($errors)) {
                                //$fileName = uniqid("prodImage_$productId.$fileExt");
                                move_uploaded_file($fileTmp, $_SERVER['DOCUMENT_ROOT'] . "/lab6/images/" . $fileName);
                                $newImage = $fileName;
                            }
                            else var_dump($errors);
                        }

                        $count = updateProductInfo($productId, $newName, $newPrice, $newImage, $newCatId);
                        if($count) {
                            $returnQS = $_SERVER['QUERY_STRING'];
                            $msg[] = "Product updated successfully";
                        }
                        else $msg[] = "Failed to update product";
                        break;

                    case 'Delete':
                        deleteProduct($productId);
                        break;

                    default:
                        break;
                }

                if($msg) include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/msgbox.php");
            ?>
        
            <section id="content">
                <a href="/lab6/admin/products.php">Go back</a>
                <hr>
                
                <?php
                    $product = getProductInfo($productId);
                    if(!$product) {
                        echo "This product does not exist or has been deleted";
                        exit;
                    }

                    $image = $product['image'];
                    if(!$image) $image = "default.png";
                ?>

                <!-- Method is post to handle image upload -->
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div id="left">
                        <h4><?php echo $product['product']; ?></h4>
                        <img src="/lab6/images/<?php echo $image; ?>">
                    </div>

                    <div id="right">
                        <label>Category:
                            <select name="catId">
                                <?php
                                    $categories = getCategories();

                                    $doc = new DOMDocument();
                                    foreach($categories as $cat) {
                                        $option = $doc->createElement("option");
                                        $option->setAttribute("value", $cat['category_id']);
                                        if($product['category_id'] === $cat['category_id'])
                                            $option->setAttribute("selected", "true");
                                        $option->appendChild($doc->createTextNode($cat['category']));
                                        $doc->appendChild($option);
                                    }
                                    echo $doc->saveHTML();
                                ?>
                            </select>
                        </label>

                        <br>
                        <label>Name: <input class="txtBox" type="text" name="prodName" value="<?php echo $product['product']; ?>"></label>
                        <label>Price: <input class="txtBox" type="text" name="price" value="<?php echo $product['price']; ?>"></label>
                        <label>Description: <input class="txtBox" type="text" name="description" value="(Not Implemented)" disabled></label>
                        <label>New image: <input class="inFile" type="file" name="image"></label>
                        <input type="hidden" name="prevImage" value="<?php echo $product['image']; ?>">

                        <hr>
                        <input type="submit" name="prodAction" value="Update">
                        <input type="reset">
                        <input type="submit" name="prodAction" value="Delete">
                    </div>
                </form>
            </section>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        
        </div>
    </body>
</html>