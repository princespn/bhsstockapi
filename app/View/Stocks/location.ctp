<div class="container">
<div class="list-group">
<div class="list-group-item active">Location | Bin Rack  </div>
<?php
foreach ($stocks as $key => $stock):
?>
<div class="list-group-item"><?php echo $stock->BinRack; ?> | <?php echo $stock->LocationName; ?></div>
<?php endforeach; ?>
</div>
</div>