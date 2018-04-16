<h2>
    <?php
        if($mode === "Save") {
            echo "Updating record with Id: $corpId";
            $tmpName = $corp['corp'];
            $tmpEmail = $corp['email'];
            $tmpZip = $corp['zipcode'];
            $tmpOwner = $corp['owner'];
            $tmpPhone = $corp['phone'];
        }
        else if($mode === "Add") {
            echo "Create record";
            $tmpName = "";
            $tmpEmail = "";
            $tmpZip = "";
            $tmpOwner = "";
            $tmpPhone = "";
        }
    ?>
</h2>
<form action="index.php" method="POST">
    <input type="hidden" name="corpId" value="<?php if($mode === "Save") echo $corpId; else echo '-1'; ?>">
    <label class="corpInputLbl">Corp name: <input class="corpInput" type="text" name="corpName" value="<?php echo $tmpName; ?>"></label>
    <label class="corpinputLbl">Email: <input class="corpInput" type="text" name="email" value="<?php echo $tmpEmail; ?>"></label>
    <label class="corpInputLbl">Zip code: <input class="corpInput" type="text" name="zipcode" value="<?php echo $tmpZip; ?>"></label>
    <label class="corpInputLbl">Owner: <input class="corpInput" type="text" name="owner" value="<?php echo $tmpOwner; ?>"></label>
    <label class="corpInputLbl">Phone: <input class="corpInput" type="text" name="phone" value="<?php echo $tmpPhone; ?>"></label>
    <input type="submit" name="action" value="<?php echo $mode; ?>">
    <button><a class="linkBtn" href="index.php">Back</a></button>
</form>