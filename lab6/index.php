<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Shopping Cart - User</title>
        <meta charset="UTF-8">
        <link href="css/positions.css" type="text/css" rel="stylesheet">
        <link href="css/colors.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div id="wrapper">
            <?php include_once("master/header.html"); ?>
            <?php
                session_start();
                $_SESSION['testKey'] = true;
            ?> 

            <section id="content">
                <p>Placeholder Content</p>
                <a href="/lab6/admin/index.php">Admin page</a>
            </section>

            <?php include_once("master/footer.html"); ?>
        </div>
    </body>
</html>