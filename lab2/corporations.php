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

        // Create form for user interaction
        $newForm = $doc->createElement("form");
        $newForm->setATtribute("class", "corpListForm");
        $newForm->setAttribute("action", "index.php");
        $newForm->setAttribute("method", "POST");

        // Set corpId: internal use
        $hdnCorpId = $doc->createElement("input");
        $hdnCorpId->setAttribute("type", "hidden");
        $hdnCorpId->setAttribute("name", "corpId");
        $hdnCorpId->setAttribute("value", $corp['id']);

        // Create form buttons
        // Read
        $readButton = $doc->createElement("input");
        $readButton->setAttribute("class", "corpListBtn");
        $readButton->setAttribute("type", "submit");
        $readButton->setAttribute("name", "action");
        $readButton->setAttribute("value", "Read");

        // Update
        /*$updateButton = $doc->createElement("input");
        $updateButton->setAttribute("class", "corpListBtn");
        $updateButton->setAttribute("type", "submit");
        $updateButton->setAttribute("name", "action");
        $updateButton->setAttribute("value", "Update");*/

        // Append child elements
        $newForm->appendChild($hdnCorpId);
        $newForm->appendChild($readButton);
        //$newForm->appendChild($updateButton);
        $doc->appendChild($corpName);
        $doc->appendChild($newForm);
        $doc->appendChild($doc->createElement("hr"));

        $count++;
    }

    // Add record form
    $formAdd = $doc->createElement("form");
    $formAdd->setAttribute("action", "index.php");
    $formAdd->setAttribute("method", "POST");

    // Add record button
    $btnCreate = $doc->createElement("input");
    $btnCreate->setAttribute("type", "submit");
    $btnCreate->setAttribute("name", "action");
    $btnCreate->setAttribute("value", "Create");

    $formAdd->appendChild($btnCreate);
    $doc->appendChild($formAdd);

    echo $doc->saveHTML(); // Write to DOM
?>