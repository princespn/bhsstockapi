<?php  if((AuthComponent::user('role'))!='1'){
$this->requestAction('/logout/', array('return'));
}?>
<?php foreach($users as $user): ?>	
<div class="container">
<?php echo $this->Session->flash(); ?>
  <div class="panel panel-primary">
  	<div class="panel-heading">
    	<h3 class="panel-title"><?php echo $user['User']['username']; ?></h3>
    </div>
  	<div class="panel-body"><?php echo $user['User']['email']; ?></div>
      <!-- List group -->
      <ul class="list-group">
        <li class="list-group-item"><strong>Created: </strong><?php echo $this->Time->niceShort($user['User']['created']); ?></li>
        <li class="list-group-item"><strong>Last Update: </strong><?php echo $this->Time->niceShort($user['User']['modified']); ?></li>
       <li class="list-group-item">
			<?php 
			if( $user['User']['username'] != 'admin'){ 
			echo $this->Html->link("Edit",   array('action'=>'edit', $user['User']['id']),array('class'=>'btn btn-primary')); ?> | 
			<?php
			echo $this->Html->link("Delete", array('action'=>'delete', $user['User']['id']),array('class'=>'btn btn-success'));
			}else{	
				echo $this->Html->link("Edit",   array('action'=>'edit', $user['User']['id']),array('class'=>'btn btn-primary'));  
				}?>
					
        </li>
      </ul>
  </div>  
</div>
<?php endforeach; ?>
<?php unset($user); ?>
<div class="container">
<div class="panel panel-primary">
<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
<?php echo $this->Paginator->numbers(array(   'class' => 'numbers'     ));?>
<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>
</div>