<div class="container">
<div class="list-group">
<div class="list-group-item active">Location | Stock Level | In Orders | Available </div>
<?php
foreach ($stocks as $key => $stock):
?>
<div class="list-group-item"><?php echo $stock->Location->LocationName; ?> | <?php echo $stock->StockLevel ?> | <?php echo $stock->InOrders; ?> | <?php echo $stock->Available; ?></div>
<?php endforeach; ?>
</div>	
</div>