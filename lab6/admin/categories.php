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
        <link href="/lab6/css/displays.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/msgbox.css" type="text/css" rel="stylesheet">
    </head>
    
    <body>
        <div id="background"></div>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>

            <?php
                $msg = array();

                $catAction = filter_input(INPUT_GET, 'catAction', FILTER_SANTIZE_STRING) ?? NULL;
                $catId = filter_input(INPUT_GET, 'catId', FILTER_VALIDATE_INT) ?? NULL;
                $catName = filter_input(INPUT_GET, 'catName', FILTER_SANITIZE_STRING) ?? NULL;

                $update = false;

                switch($catAction) {
                    case 'Add':
                        addCategory($catName);
                        break;
                    case 'startUpdate':
                        $update = true;
                        break;
                    case 'Update':
                        updateCategory($catId, $catName);
                        break;
                    case 'Delete':
                        $count = deleteCategory($catId);
                        if($count === 'err_cat_not_empty')
                            $msg[] = 'Category must be empty to delete';
                        break;
                    default:
                        break;
                }

                if($msg) include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/forms/msgbox.php");
            ?>
        
            <section id="content">
                <div class="formCenter">
                    <a href="/lab6/admin/index.php">Go back</a>
                    <hr>
                </div>

                <h3>
                    <?php
                        if(!$update) echo 'Create New Category';
                        else echo "Update Category with id: $catId";
                    ?>
                </h3>
                <form action="#" method="GET">
                    <input type="hidden" name="catId" value="<?php echo $catId; ?>">
                    <label>Name: <input type="text" name="catName" required></label>
                    <input type="submit" name="catAction" value="<?php
                        if($update) echo "Update"; else echo "Add";
                    ?>">
                    <?php
                        if($update) {
                            $doc = new DOMDocument();
                            $cancelLink = $doc->createElement("a");
                            $cancelLink->setAttribute("href", "/lab6/admin/categories.php");
                            $cancelLink->appendChild($doc->createTextNode("Cancel"));
                            $doc->appendChild($cancelLink);
                            echo $doc->saveHTML();
                        }
                    ?>
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
                        $viewLink->appendChild($doc->createTextNode($cat['category_id'] . ", " . $cat['category']));
                        $div->appendChild($viewLink);

                        $div->appendChild($doc->createTextNode(' | '));

                        $updateLink = $doc->createElement("a");
                        $updateLink->setAttribute("href", "?catAction=startUpdate&catId=" . $cat['category_id']);
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