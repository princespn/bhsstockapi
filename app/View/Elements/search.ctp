<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
	<?php echo $this->Form->create('Stock', array('action' => 'details','class'=>'search-block','role'=>'search')); ?> 
        <div class="form-group">
          <label for="inputHelpBlock">Search Barcode,Title and Category..</label>
          <?php echo $this->Form->input('keyword',array('label'=>false,'class'=>'form-control input-lg','placeholder'=>'Search Barcode,Title..')); ?>
		</div>
		<?php echo $this->Form->button('Search',array('class'=>'btn btn-success btn-block btn-lg'));?>
		<?php echo $this->Form->end(); ?>
    </div>
    <div class="panel-footer"></div>
  </div>
</div>