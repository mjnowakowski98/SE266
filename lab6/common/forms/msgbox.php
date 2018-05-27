<section class="msgBox dimmerOverlay">
    <?php
        $returnQS = $returnQS ?? NULL; // Used if querystring data needs to persist beyond reload

        $msg = $msg ?? NULL;
        if($msg) {
            $doc = new DOMDocument();
            foreach($msg as $outLine) {
                $p = $doc->createElement("p");
                $p->appendChild($doc->createTextNode($outLine));
                $doc->appendChild($p);
            }
            echo $doc->saveHTML();
        }
    ?>
    <hr>
    <a href="?<?php echo $returnQS; // Clear querystring if not set ?>">OK</a>
</section>