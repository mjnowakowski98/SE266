<?php
    $isAdminPage = true; // Specify that page is restricted, phphead/header will handle lockout
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
        
            <!-- basic links to admin pages -->
            <section id="content" class="formCenter">
                <a href="/lab6/admin/categories.php">Category Management</a> |
                <a href="/lab6/admin/products.php">Product Management</a> |
                <a href="/lab6/common/vieworders.php">Order Managment</a>
            </section>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/common/footer.php"); ?>
        
        </div>
    </body>
</html>