<?php
    $doc = new DOMDocument(); // Get existing DOM

    // Form header
    $formHead = $doc->createElement("h2");
    $formHead->appendChild($doc->createTextNode("Create Record"));
    $doc->appendChild($formHead);

    // Update form
    $updateForm = $doc->createElement("form");
    $updateForm->setAttribute("action", "index.php");
    $updateForm->setAttribute("method", "POST");

    // Name field
    $lblName = $doc->createElement("label");
    $lblName->appendChild($doc->createTextNode("Corp Name: "));
    $lblName->setAttribute("for", "corpName");
    $nameBox = $doc->createElement("input");
    $nameBox->setAttribute("type", "text");
    $nameBox->setAttribute("name", "corpName");
    $updateForm->appendChild($lblName);
    $updateForm->appendChild($nameBox);

    // Inc date
    $lblIncDt = $doc->createElement("label");
    $lblIncDt->setAttribute("for", "incDt");
    $lblIncDt->appendChild($doc->createTextNode("Incorporated date: "));
    $incDt = $doc->createElement("input");
    $incDt->setAttribute("type", "text");
    $incDt->setAttribute("name", "incDt");
    $updateForm->appendChild($lblIncDt);
    $updateForm->appendChild($incDt);

    // Email
    $lblEmail = $doc->createElement("label");
    $lblEmail->setAttribute("for", "email");
    $lblEmail->appendChild($doc->createtextNode("Email: "));
    $email = $doc->createElement("input");
    $email->setAttribute("type", "text");
    $email->setAttribute("name", "email");
    $updateForm->appendChild($lblEmail);
    $updateForm->appendChild($email);

    // Zip
    $lblZip = $doc->createElement("label");

    // Submit button
    $btnAdd = $doc->createElement("input");
    $btnAdd->setAttribute("type", "submit");
    $btnAdd->setAttribute("name", "action");
    $btnAdd->setAttribute("value", "Add");
    $updateForm->appendChild($btnAdd);

    // Set label classes
    foreach($updateForm->getElementsByTagName("label") as $node) {
        $node->setAttribute("class", "corpInputLbl");
    }

    // Set input classes
    foreach($updateForm->getElementsByTagName("input") as $node) {
        if($node !== $btnAdd) $node->setAttribute("class", "corpInput");
    }

    $doc->appendChild($updateForm);

    echo $doc->saveHTML(); // Write to DOM
?>