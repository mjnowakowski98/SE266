<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Shopping Cart - User</title>
        <meta charset="UTF-8">
        <link href="/lab6/css/master.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/formparts.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/effects.css" type="text/css" rel="stylesheet">
        <link href="/lab6/css/displays.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div id="wrapper">
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/header.php"); ?>

            <section id="content">
                <section class="displayRow">
                    <div class="displayLeft displayHalf">
                        <img src="/lab6/images/default.png">
                        <p>TestLeft</p>
                    </div>
                    <div class="displayRight displayHalf">
                        <p>TestRight</p>
                    </div>
                    <br class="displayRow">
                </section>

                <section class="displayRow">
                    <div class="displayLeft displayQtr">
                        <img src="/lab6/images/default.png">
                        <p>TestLeft</p>
                    </div>
                    <div class="displayLeft displayQtr">
                        <p>TestLeft</p>
                    </div>

                    <div class="displayRight displayQtr">
                        <p>TestRight</p>
                    </div>
                    <div class="displayRight displayQtr">
                        <p>TestRight</p>
                    </div>
                    <br class="displayRow">
                </section>
            </section>

            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lab6/master/footer.php"); ?>
        </div>
    </body>
</html>