<h2>Showing Record ID: <?php echo $corpId; ?></h2>
<div id="corpOut">
    <p class="infotext"><strong>Company: </strong><?php echo $corp['corp']; ?></p>
    <p class="infotext"><strong>Incorporated: </strong><?php echo date("m/d/Y",strtotime($corp['incorp_dt'])); ?></p>
    <p class="infotext"><strong>Email: </strong><?php echo $corp['email']; ?></p>
    <p class="infotext"><strong>Zip: </strong><?php echo $corp['zipcode']; ?></p>
    <p class="infotext"><strong>Owner: </strong><?php echo $corp['owner']; ?></p>
    <p class="infotext"><strong>Phone: </strong><?php echo $corp['phone']; ?></p>
    <form action="index.php" method="GET">
        <input type="hidden" name="corpId" value="<?php echo $corpId; ?>">
        <input type="submit" name="action" value="Update">
        <input type="submit" name="action" value="Delete">
        <button><a class="linkBtn" href="index.php">Back</a></button>
    </form>
</div>