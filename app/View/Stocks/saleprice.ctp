<div class="container">
<div class="list-group">
<div class="list-group-item active">Sale Price</div>
<?php
print_r($prices);
foreach ($prices as $key => $price):
?>
<div class="list-group-item"><?php // echo $prices ?></div>
<?php endforeach; ?>
</div>	
</div>