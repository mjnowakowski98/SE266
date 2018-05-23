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
                $catAction = $_GET['catAction'] ?? NULL;
                $catId = $_GET['catId'] ?? NULL;
                $catName = $_GET['catName'] ?? NULL;

                $update = false;

                switch($catAction) {
                    case 'Add':
                        addCategory($catName);
                        break;
                    case 'Update':
                        $update = true;
                        break;
                    case 'sendUpdate':
                        var_dump(updateCategory($catId, $catName));
                        break;
                    case 'Delete':
                        break;
                }
            ?>
        
            <section id="content">
                <h3><?php
                    if(!$update) echo 'Create New Category';
                    else echo "Update Category with id: $catId";
                ?></h3>
                <form action="#" method="GET">
                    <input type="hidden" name="catId" value="<?php echo $catId; ?>">
                    <input type="hidden" name="catAction" value="<?php
                    if($update) echo 'sendUpdate'; else echo 'Add'?>">
                    <label>Name: <input type="text" name="catName" required></label>
                    <input type="submit">
                </form>

                <h3>Existing Categories:</h3>

                <?php
                    $categories = getCategories();
                    $doc = new DOMDocument();
                    foreach($categories as $cat) {
                        $div = $doc->createElement("div");
                        $doc->appendChild($div);

                        $viewLink = $doc->createElement("a");
                        $viewLink->setAttribute("href", "/lab6/index.php?catId=" . $cat['category_id']);
                        $viewLink->appendChild($doc->createTextNode($cat['category']));
                        $div->appendChild($viewLink);

                        $div->appendChild($doc->createTextNode(' | '));

                        $updateLink = $doc->createElement("a");
                        $updateLink->setAttribute("href", "?catAction=Update&catId=" . $cat['category_id']);
                        $updateLink->appendChild($doc->createTextNode("Update"));
                        $div->appendChild($updateLink);

                        $div->appendChild($doc->createTextNode(' | '));

                        $deleteLink = $doc->createElement("a");
                        $deleteLink->setAttribute("href", "?catAction=Delete&catId=" . $cat['category_id']);
                        $deleteLink->appendChild($doc->createTextNode("Delete"));
                        $div->appendChild($deleteLink);
                    }

                    echo $doc->saveHTML();
                ?>
            </section>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        
        </div>
    </body>
</html>