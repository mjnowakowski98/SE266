<!-- Not Yet Implemented, do not include -->

<form action="#" method="GET">
    <select name="siteID">
        <option value>Choose a site</option>
        <?php
            $doc = new DOMDocument();

            $newOption = $doc->createElement("option");

            $doc->appendChild($newOption);

            echo $doc->saveHTML();
        ?>
    </select>
</form>