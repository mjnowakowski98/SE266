<?php
    $doc = new DOMDocument(); // Get document

    // Output list of corporations
    $count = 0;
    foreach($corporations as $corp) {
        // Output corporation name
        $corpName = $doc->createElement("span");
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
        $readButton = $doc->CreateElement("input");
        $readButton->setAttribute("type", "submit");
        $readButton->setAttribute("name", "action");
        $readButton->setAttribute("value", "Read");

        // Append child elements
        $newForm->appendChild($hdnCorpId);
        $newForm->appendChild($readButton);
        $corpName->appendChild($newForm);
        $doc->appendChild($corpName);
        $doc->appendChild($doc->createElement("br"));

        $count++;
    }

    echo $doc->saveHTML(); // Write to DOM
?>