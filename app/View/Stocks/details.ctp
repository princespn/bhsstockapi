  <?php echo $this->element('search'); ?>
  <div class="container">
   
<?php
//print_r($stocks->Data);
//foreach ($stocks as $key => $stockkey['Data ']):
foreach ($stocks->Data as  $stock):
?>
 <div class="panel panel-primary">
  	<div class="panel-heading">
    	<?php // if(!empty($catname)){ echo $catname;} ?>
    <h3 class="panel-title"><?php echo $stock->ItemTitle; ?></h3></div>
<?php // echo "<div class="panel-body"></div>"; ?>
         
      <ul class="list-group">
	  <li class="list-group-item"><strong>SKU: </strong><?php echo $stock->ItemNumber; ?></li>
       <li class="list-group-item"><strong>Barcode: </strong><?php echo $stock->BarcodeNumber; ?></li>
        <li class="list-group-item"><strong>Quantity: </strong><?php echo $stock->Quantity; ?></li>
        <li class="list-group-item">
			<?php echo $this->Html->link('Location', 'location/'.$stock->StockItemId,array('class'=>'btn btn-primary'));?>
        	<?php echo $this->Html->link('Stock Level', 'level/'.$stock->StockItemId,array('class'=>'btn btn-success'));?>
        	
        </li>
      </ul>
</div>
<?php endforeach; ?>
<?php //endforeach; ?> 

</div>