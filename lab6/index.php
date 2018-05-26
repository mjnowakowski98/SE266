<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/phphead.php");

/*
TODO:
    Clean CSS/Page Formatting
    Add admin update products --
    Add product search (Cust/admin)
    Add product sort (Cust/admin)
    Implement admin delete category
    Add some more categories/products
    Remove notice on file upload*
    Add total price to cart
    Restrict order detail view to admin/current user
    Restrict admins from buying items
    Change get/post vars to filter input
    Support descriptions
    Display err messages from header
    Implement err messages where applicible

    // For the love of Satan, do not open this in Firefox or IE
*/
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trader Dan's</title>
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

            <section id="content">
                <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/products.php"); ?>
            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        </div>
    </body>
</html>