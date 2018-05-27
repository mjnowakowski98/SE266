<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php");

/*
TODO:
    // Admin Pages
    Restrict admins from buying items
    Allow select prev upload from images

    // UI
    ?? Display lowest catId first (remove all)
    --Display err messages from auth head--
    Add product search (Cust/admin)
    Add product sort (Cust/admin)
    Add total price to cart
    Restrict order detail view to admin/current user
    Support descriptions
    Add return to shopping link from cart

    // Code
    Clean CSS/Page Formatting
    Comment the everything
    Set file upload name conventions
    Move file upload handling to master/utils

    // Tables
    Add user address to userinfo
    Add price paid to orderitems

    // Misc
    Add some more categories/products
    Remove notice on file upload*
    Fix css on other engines
*/
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's</title>
        <meta charset="UTF-8">

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/mastercsslinks.php"); ?>
        <link href="/lab6/css/displays.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div id="background"></div>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/header.php"); ?>

            <section id="content">
                <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/products.php"); ?>
            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </div>
    </body>
</html>