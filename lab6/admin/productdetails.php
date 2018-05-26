<?php
    $isAdminPage = true;
    include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's Admin Panel</title>
        <meta charset="UTF-8">
        <link href="/lab6/css/master.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/formparts.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/effects.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/productdetails.css" type="text/css" rel="stylesheet">
    </head>
    
    <body>
        <div id="background"></div>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>

            <?php
                $productId = $_REQUEST['productId'] ?? NULL;

                $prodAction = $_POST['prodAction'] ?? NULL;
                switch($prodAction) {
                    case 'Update':
                        $newName = $_POST['prodName'] ?? NULL;
                        $newPrice = $_POST['price'] ?? NULL;
                        //$newDesc = $_POST['description'];
                        $newCatId = $_POST['catId'] ?? NULL;
                        $newImage = $_POST['prevImage'];

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

                        updateProductInfo($productId, $newName, $newPrice, $newImage, $newCatId);
                        break;

                    case 'Delete':
                        deleteProduct($productId);
                        break;

                    default:
                        break;
                }
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