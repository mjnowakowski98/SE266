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
                $prodAction = $_POST['prodAction'] ?? NULL;
                $lastImage = $_POST['lastImage'] ?? NULL;
                $prodName = $_POST['prodName'] ?? NULL;
                $price = $_POST['price'] ?? NULL;
                $catId = $_POST['catId'] ?? NULL;

                $imageFile = $_FILES['image'] ?? NULL;
                if($imageFile) {
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
                        echo '<br>';
                        var_dump($count);
                        break;
                    default:
                        break;
                }

            ?>
        
            <section id="content">
                <!-- method is post for image uploading, would be get otherwise -->
                <form action="#" method="POST" enctype="multipart/form-data">
                    <h3>Add New Product</h3>
                    <input type="hidden" name="prodAction" value="Add">
                    <input type="hidden" name="lastImage" value="">
                    <label>Name: <input type="text" name="prodName"></label>
                    <label>Price: <input type="text" name="price"></label>
                    <label>Category:
                        <select name="catId">
                            <option value="All">All</option>
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

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        
        </div>
    </body>
</html>