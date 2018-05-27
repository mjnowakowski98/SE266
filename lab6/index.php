<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php");

/*
TODO:
    // UI
    ??Add product search (Cust/admin)
    ??Add product sort (Cust/admin)
    Move total/tax to checkout case (cart)
    Use customer address to determine if taxable

    // Code
    Comment the everything
    Move file upload handling to master/utils

    // Tables
    Add user address to userinfo

    // Misc
    Add some more categories/products
    ??Remove notice on file upload *may be gone already
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