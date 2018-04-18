<?php
    $columns = getColumnInfo();
?>

<form action="index.php" method="GET">
    <label>Sort Column:
        <select name="sortCol">
            <?php
                $doc = new DOMDocument();
                foreach($columns as $column) {
                    $value = $column['Field'];

                    $newOption = $doc->createElement("option");
                    $newOption->setAttribute("name", "sortCol");
                    $newOption->setAttribute("value", $value);
                    $newOption->appendChild($doc->createTextNode($value));
                    $doc->appendChild($newOption);
                }

                echo $doc->saveHTML();
            ?>
        </select>
    </label>
    <!-- TODO: Not required, consider making radio values persistent -->
    <label>Ascending: <input type="radio" name="sortDir" value="ASC" checked></label>
    <label>Descending: <input type="radio" name="sortDir" value="DESC"></label>
    <input type="submit">
    <input type="reset">
</form>

<br>
<form action="index.php" method="GET">
    <label> Search Column: 
        <select name="searchCol">
            <?php
                $doc = new DOMDocument();
                foreach($columns as $column) {
                    $value = $column['Field'];

                    $newOption = $doc->createElement("option");
                    $newOption->setAttribute("name", "sortCol");
                    $newOption->setAttribute("value", $value);

                    $newOption->appendChild($doc->createTextNode($value));

                    $doc->appendChild($newOption);
                }

                echo $doc->saveHTML();
            ?>
        </select>
    </label>
    <label>Term: <input type="search" name="searchTerm"></label>
    <input type="submit">
    <input type="reset">
</form>

<hr>
<?php
    $doc = new DOMDocument(); // Get document

    // Output list of corporations
    $count = 0;
    foreach($corporations as $corp) {
        // Output corporation name
        $corpName = $doc->createElement("p");
        $corpName->setAttribute("class", "corpList");
        $corpName->setAttribute("id", "corpList" . "$count");
        $corpName->appendChild($doc->createTextNode($corp['corp']));
        $doc->appendChild($corpName);

        // Create form for user interaction
        $newForm = $doc->createElement("form");
        $newForm->setATtribute("class", "corpListForm");
        $newForm->setAttribute("action", "index.php");
        $newForm->setAttribute("method", "GET");

        // Set corpId: internal use
        $hdnCorpId = $doc->createElement("input");
        $hdnCorpId->setAttribute("type", "hidden");
        $hdnCorpId->setAttribute("name", "corpId");
        $hdnCorpId->setAttribute("value", $corp['id']);
        $newForm->appendChild($hdnCorpId);

        // Create form buttons
        // Read
        $readButton = $doc->createElement("input");
        $readButton->setAttribute("class", "corpListBtn");
        $readButton->setAttribute("type", "submit");
        $readButton->setAttribute("name", "action");
        $readButton->setAttribute("value", "Read");
        $newForm->appendChild($readButton);

        // Update
        $updateButton = $doc->createElement("input");
        $updateButton->setAttribute("class", "corpListBtn");
        $updateButton->setAttribute("type", "submit");
        $updateButton->setAttribute("name", "action");
        $updateButton->setAttribute("value", "Update");
        $newForm->appendChild($updateButton);

        // Delete
        $deleteButton = $doc->createElement("input");
        $deleteButton->setAttribute("class", "corpListBtn");
        $deleteButton->setAttribute("type", "submit");
        $deleteButton->setAttribute("name", "action");
        $deleteButton->setAttribute("value", "Delete");
        $newForm->appendChild($deleteButton);

        $doc->appendChild($newForm);
        $doc->appendChild($doc->createElement("hr"));

        $count++;
    }

    echo $doc->saveHTML(); // Write to DOM
?>

<form action="index.php" method="POST">
    <input class="corpListBtn" type="submit" name="action" value="Create">
</form>