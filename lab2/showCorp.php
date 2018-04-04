<?php
    $html = '
        <h2>Showing Record ID: </h2>
        <div id="corpOut">
            <p class="infotext"><strong>Company: </strong> ' . $corp['corp'] . '</p>
            <p class="infotext"><strong>Incorporated: </strong> ' . $corp['incorp_dt'] . '</p>
            <p class="infotext"><strong>Email: </strong> ' . $corp['email'] . '</p>
            <p class="infotext"><strong>Zip: </strong> ' . $corp['zipcode'] . '</p>
            <p class="infotext"><strong>Owner: </strong> ' . $corp['owner']  . '</p>
            <p class="infotext"><strong>Phone: </strong> ' . $corp['phone'] . '</p>
        </div>
    ';

    echo $html;
?>