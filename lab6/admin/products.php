<?php
    $isAdminPage = true;
    include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php");
?>

<!-- TODO: Make this look fancy -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's Admin Panel</title>
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

            <?php
                $prodAction = filter_input(INPUT_POST, 'prodAction', FILTER_SANITIZE_STRING) ?? NULL;
                $prodName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING) ?? NULL;
                $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT) ?? NULL;
                $catId = filter_input(INPUT_POST, 'catId', FILTER_VALIDATE_INT) ?? NULL;

                $imageFile = $_FILES['image'] ?? NULL;
                if($imageFile['size']) {
                    $errors = array();
                    $fileName = $imageFile['name'];
                    $fileSize = $imageFile['size'];
                    $fileTmp = $imageFile['tmp_name'];
                    $fileType = $imageFile['type'];
                    var_dump($fileName);
                    $fileExt = strtolower(end(explode('.',$_FILES['image']['name'])));

                    $extensions = array("jpeg", "jpg", "png");
                    if(!in_array($fileExt, $extensions))
                        $errors[] = 'File extension not supported, must be JPG or PNG';

                    if($fileSize > 2097152)
                        $errors[] = 'File size must not exceed 2MB';

                    if(empty($errors))
                        move_uploaded_file($fileTmp, $_SERVER['DOCUMENT_ROOT'] . "/lab6/images/" . $fileName);
                    else var_dump($errors);
                }

                $fileName = $fileName ?? NULL;

                switch($prodAction) {
                    case 'Add':
                        $count = addProduct($prodName, $price, $fileName, $catId);
                        break;
                    default:
                        break;
                }

            ?>
        
            <section id="content">
                <div class="formCenter">
                    <a href="/lab6/admin/index.php">Go back</a>
                    <hr>
                </div>

                <section id="addProduct">
                    <!-- method is post for image uploading, would be get otherwise -->
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <h3>Add New Product</h3>
                        <input type="hidden" name="prodAction" value="Add">
                        <label>Name: <input class="txtBox" type="text" name="prodName"></label>
                        <label>Price: <input class="txtBox" type="text" name="price"></label>
                        <label>Category:
                            <select name="catId">
                                <?php
                                    $categories = getCategories();

                                    $doc = new DOMDocument();
                                    foreach($categories as $cat) {
                                        $option = $doc->createElement("option");
                                        $option->setAttribute("value", $cat['category_id']);
                                        $option->appendChild($doc->createTextNode($cat['category']));
                                        $doc->appendChild($option);
                                    }
                                    echo $doc->saveHTML();
                                ?>
                            </select>
                        </label>

                        <p>Choose an Image:</p>
                        <input type="file" name="image">
                        <input type="submit">
                    </form>
                </section>
                
                <hr>
                <section id="updateProduct">
                    <h3>Update products</h3>
                    <?php
                        $adminSender = true;
                        include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/products.php");
                    ?>           
                </section>
            </section>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        
        </div>
    </body>
</html>