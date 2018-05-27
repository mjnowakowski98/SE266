<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php");

/*
TODO:
    // Admin Pages
    Restrict admins from buying items
    Allow select prev upload from images

    // UI
    ??Add product search (Cust/admin)
    ??Add product sort (Cust/admin)
    Add adjust qty to cart
    Move total/tax to checkout case (cart)
    ??Support descriptions

    // Code
    ??Clean CSS/Page Formatting
    Comment the everything
    ??Set file upload name conventions
    Move file upload handling to master/utils

    // Tables
    Add user address to userinfo
    Add shipping date to orders
    Add totalprice to orders
    Add price paid to orderitems

    // Misc
    Add some more categories/products
    ??Remove notice on file upload *may be gone already
    ??Fix css on other engines (only really works on webkit rn)
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