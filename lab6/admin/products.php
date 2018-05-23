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
                
            ?>
        
            <section id="content">
                <!-- method is post for image uploading, would be get otherwise -->
                <form action="#" method="POST" enctype="multipart/form-data">
                    <h3>Add New Product</h3>
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
                                    $option->setAttribute("value", $cat['category']);
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