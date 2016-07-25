<?php echo $this->element('search'); ?>
<div class="container">
<div  class="list-group">
<?php
//print_r($stocks);
foreach ($stocks as $key => $stock):
?>
<?php echo $this->Html->link($stock->CategoryName, 'details/'.$stock->CategoryName,array('class'=>'list-group-item','id'=>'list-id'));?>
<?php endforeach; ?>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$('.list-group-item').on('click',function(){
   $('.list-group-item').removeClass('active');
		$(this).addClass('active');
    });
});
</script>