<!-- SE266.05 Lab 4 Matthew Nowakowski -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Lab 4</title>
        <link href="./master.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1>Corporations App</h1>
        </header>
        <hr>
        <!-- TODO: Style wrapper, eventually -->
        <div id="wrapper">
            <?php
                // Include database functions
               require_once("dbcontroller.php");
               require_once("dbfunctions.php");

                function outCorpList() {
                    // Initialize filters
                    $sortCol = NULL;
                    $sortDir = NULL;
                    $searchCol = NULL;
                    $searchTerm = NULL;

                    // If sort column is specified fill vars
                    if(array_key_exists('sortCol', $_REQUEST)) {
                        $sortCol = $_REQUEST['sortCol'];
                        $sortDir = $_REQUEST['sortDir'];
                    }

                    // If search column is specified fill vars
                    if(array_key_exists('searchCol', $_REQUEST)) {
                        $searchCol = $_REQUEST['searchCol'];
                        $searchTerm = $_REQUEST['searchTerm'];
                    }

                    // Get corp list based on sort/filters
                    $corporations = getRows($sortCol, $sortDir, $searchCol, $searchTerm);
                    include_once("corporations.php"); // Build and show the list
               }

               // Check if a form submitted a request with name 'action'
               if(array_key_exists('action', $_REQUEST)) {
                   $action = $_REQUEST['action'];
                   if(array_key_exists('corpId', $_REQUEST)) $corpId = $_REQUEST['corpId']; // Check if id was passed as well
                   switch($action) {
                        case "Read":
                            $corp = getCorp($corpId);
                            include_once("showCorp.php");
                            break;
                        case "Update":
                            $corp = getCorp($corpId); // Get corp info to autofill
                            $mode = "Save"; // corpForm has two modes, one to update, one to create
                            include_once("corpForm.php");
                            break;
                        case "Save":
                            $count = updateCorp($corpId);
                            echo "$count rows affected.";

                            // corpForm has two modes, one to update, one to create
                            $mode = "Save"; // Re-use same mode to redisplay form
                            $corp = getCorp($corpId);
                            include_once("corpForm.php");
                            break;
                        case "Delete":
                            $count = deleteCorp($corpId);
                            echo "$count rows affected <hr>";
                            outCorpList();
                            break;
                        case "Create":
                            $mode = "Add"; // corpForm has two modes, one to update, one to create
                            include_once("corpForm.php");
                            break;
                        case "Add":
                            $mode = "Add"; // Re-use same mode
                            // Setup corp info from corpForm
                            $corpName = $_REQUEST['corpName'];
                            $incDt = $_REQUEST['incDt'];
                            $email = $_REQUEST['email'];
                            $zip = $_REQUEST['zipcode'];
                            $owner = $_REQUEST['owner'];
                            $phone = $_REQUEST['phone'];
                            $count = addCorp($corpName, $incDt, $email, $zip, $owner, $phone);
                            echo "$count rows affected";
                            include_once("corpForm.php");
                            break;
                        default: // Fallback in case action is invalid
                            outCorpList(); // Output database list
                            break;
                   }
                } else outCorpList(); // Output all if not
            ?>
        </div>
    </body>
</html>