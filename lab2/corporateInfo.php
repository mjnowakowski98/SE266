<?php
    $doc = new DOMDocument(); // Get document

    $div = $doc->createElement("div");
    $div->setAttribute("class", "corpOut");

    $company = $doc->createElement("p");
    $lblCompany = $doc->createElement("strong");
    $lblCompany->appendChild($doc->createTextNode("Company: "));
    $company->appendChild($lblCompany);
    $company->appendChild($doc->createTextNode($corp['corp']));

    $incDate = $doc->createElement("p");
    $lblIncDate = $doc->createElement("strong");
    $lblIncDate->appendChild($doc->createTextNode("Incorporated: "));
    $incDate->appendChild($lblIncDate);
    $incDate->appendChild($doc->createTextNode($corp['incorp_dt']));

    $email = $doc->createElement("p");
    $lblEmail = $doc->createElement("strong");
    $lblEmail->appendChild($doc->createTextNode("Email: "));
    $email->appendChild($lblEmail);
    $email->appendChild($doc->createTextNode($corp['email']));

    $zip = $doc->createElement("p");
    $lblZip = $doc->createElement("strong");
    $lblZip->appendChild($doc->createTextNode("Zip: "));
    $zip->appendChild($lblZip);
    $zip->appendChild($doc->createTextNode($corp['zipcode']));

    $owner = $doc->createElement("p");
    $lblOwner = $doc->createElement("strong");
    $lblOwner->appendChild($doc->createTextNode("Owner: "));
    $owner->appendChild($lblOwner);
    $owner->appendChild($doc->createTextNode($corp['owner']));

    $phone = $doc->createElement("p");
    $lblPhone = $doc->createElement("strong");
    $lblPhone->appendChild($doc->createTextNode("Phone: "));
    $phone->appendChild($lblPhone);
    $phone->appendChild($doc->createTextNode($corp['phone']));

    $div->appendChild($company);
    $div->appendChild($incDate);
    $div->appendChild($email);
    $div->appendChild($zip);
    $div->appendChild($owner);
    $div->appendChild($phone);

    foreach($div->childNodes as $node) {
        $node->setAttribute("class", "infoText");
    }

    $doc->appendChild($div);

    echo $doc->saveHTML(); // Write to DOM
?>