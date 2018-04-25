<?php
    $columns = getColumnInfo(); // Grab column information
?>

<form action="index.php" method="GET">
    <label>Sort Column:
        <select name="sortCol">
            <?php
                // Dynamically assign options based on column names
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
    <label>Ascending: <input type="radio" name="sortDir" value="ASC" checked></label>
    <label>Descending: <input type="radio" name="sortDir" value="DESC"></label>
    <input type="submit" action="corporations.php">
    <input type="reset">
</form>

<br>
<form action="index.php" method="GET">
    <label> Search Column: 
        <select name="searchCol">
            <?php
                // Dynamically assign options based on column names
                $doc = new DOMDocument();
                foreach($columns as $column) {
                    $value = $column['Field'];

                    $newOption = $doc->createElement("option");
                    $newOption->setAttribute("name", "searchCol");
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

<table>
<tbody>
    <?php
        $doc = new DOMDocument();

        $count = 0;
        foreach($corporations as $corp) {

            // Make table-row and 1st col (CorpName)
            $newRow = $doc->createElement("tr");
            $newColName = $doc->createElement("td");

            // Output corporation name
            $corpName = $doc->createElement("p");
            $corpName->setAttribute("class", "corpList");
            $corpName->setAttribute("id", "corpList" . "$count");
            $corpName->appendChild($doc->createTextNode($corp['corp']));
            $newColName->appendChild($corpName);

            $newColForm = $doc->createElement("td"); // 2nd col (Form)

            // Create form for user interaction
            $newForm = $doc->createElement("form");
            $newForm->setAttribute("class", "corpListForm");
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

            // Append table elements
            $newColForm->appendChild($newForm);
            $newRow->appendChild($newColName);
            $newRow->appendChild($newColForm);
            $doc->appendChild($newRow); // Add row to table

            $count++;
        }

        echo $doc->saveHTML(); // Write to DOM
    ?>
</tbody>
</table>

<!-- Free floating button to create, needs a form to validate HTML -->
<form action="index.php" method="POST">
    <input class="corpListBtn" type="submit" name="action" value="Create">
</form>