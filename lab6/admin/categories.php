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
        <link href="/lab6/css/displays.css" type="text/css" rel="stylesheet">
    </head>
    
    <body>
        <div id="background"></div>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>

            <?php
                $msg = array();

                $catAction = filter_input(INPUT_GET, 'catAction', FILTER_SANITIZE_STRING) ?? NULL;
                $catId = filter_input(INPUT_GET, 'catId', FILTER_VALIDATE_INT) ?? NULL;
                $catName = filter_input(INPUT_GET, 'catName', FILTER_SANITIZE_STRING) ?? NULL;

                $update = false; // heuristic to determine add/update mode

                switch($catAction) {
                    case 'Add':
                        addCategory($catName);
                        break;
                    case 'startUpdate': // On update button clicked
                        $update = true;
                        break;
                    case 'Update': // On update submit
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
                    <?php // Section header
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
                        if($update) { // link to go back to add mode
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

                <?php // Output fancy category list
                    $categories = getCategories();
                    $doc = new DOMDocument();
                    foreach($categories as $cat) {
                        // Container
                        $div = $doc->createElement("div");
                        $doc->appendChild($div);

                        // Name/id in link form to view category from userland
                        $viewLink = $doc->createElement("a");
                        $viewLink->setAttribute("href", "/lab6/index.php?catId=" . $cat['category_id']);
                        $viewLink->appendChild($doc->createTextNode($cat['category_id'] . ", " . $cat['category']));
                        $div->appendChild($viewLink);

                        // Spacer, end link
                        $div->appendChild($doc->createTextNode(' | '));

                        // Update
                        $updateLink = $doc->createElement("a");
                        $updateLink->setAttribute("href", "?catAction=startUpdate&catId=" . $cat['category_id']);
                        $updateLink->appendChild($doc->createTextNode("Update"));
                        $div->appendChild($updateLink);

                        $div->appendChild($doc->createTextNode(' | '));

                        // Delete
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