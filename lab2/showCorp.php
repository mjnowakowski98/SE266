<?php   
    $doc = new DOMDocument(); // Get document

    // Form header
    $formHead = $doc->createElement("h2");
    $formHead->appendChild($doc->createTextNode("Showing Record ID: " . $corpId));
    $doc->appendChild($formHead);

    // Container div
    $div = $doc->createElement("div");
    $div->setAttribute("class", "corpOut");

    // Output company name
    $company = $doc->createElement("p");
    $lblCompany = $doc->createElement("strong");
    $lblCompany->appendChild($doc->createTextNode("Company: "));
    $company->appendChild($lblCompany);
    $company->appendChild($doc->createTextNode($corp['corp']));
    $div->appendChild($company);

    // Output incorporated date
    $incDate = $doc->createElement("p");
    $lblIncDate = $doc->createElement("strong");
    $lblIncDate->appendChild($doc->createTextNode("Incorporated: "));
    $incDate->appendChild($lblIncDate);
    $incDate->appendChild($doc->createTextNode($corp['incorp_dt']));
    $div->appendChild($incDate);

    // Output email
    $email = $doc->createElement("p");
    $lblEmail = $doc->createElement("strong");
    $lblEmail->appendChild($doc->createTextNode("Email: "));
    $email->appendChild($lblEmail);
    $email->appendChild($doc->createTextNode($corp['email']));
    $div->appendChild($email);

    // Output zip
    $zip = $doc->createElement("p");
    $lblZip = $doc->createElement("strong");
    $lblZip->appendChild($doc->createTextNode("Zip: "));
    $zip->appendChild($lblZip);
    $zip->appendChild($doc->createTextNode($corp['zipcode']));
    $div->appendChild($zip);

    // Output owner
    $owner = $doc->createElement("p");
    $lblOwner = $doc->createElement("strong");
    $lblOwner->appendChild($doc->createTextNode("Owner: "));
    $owner->appendChild($lblOwner);
    $owner->appendChild($doc->createTextNode($corp['owner']));
    $div->appendChild($owner);

    // Output phone #
    $phone = $doc->createElement("p");
    $lblPhone = $doc->createElement("strong");
    $lblPhone->appendChild($doc->createTextNode("Phone: "));
    $phone->appendChild($lblPhone);
    $phone->appendChild($doc->createTextNode($corp['phone']));
    $div->appendChild($phone);

    // Set every element to class 'infoText'
    foreach($div->childNodes as $node) {
        $node->setAttribute("class", "infoText");
    }

    $doc->appendChild($div);
    echo $doc->saveHTML(); // Write to DOM
?>