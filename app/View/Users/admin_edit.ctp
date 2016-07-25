<?php  if((AuthComponent::user('role'))!='1'){
$this->requestAction('/admin/users/logout/', array('return'));
}?>
<div class="container">
<?php echo $this->Form->create('User', array('action' => 'edit','class'=>'form-signin')); ?> 
    <h2 class="form-signin-heading text-center">Edit information</h2>
	<?php echo $this->Session->flash(); ?>
	
	<?php 
	echo $this->Form->hidden('id',array('value'=>$this->data['User']['id']));
	echo $this->Form->input('username',array('label'=>false,'class'=>'form-control')); ?>
	<?php echo $this->Form->input('email',array('label'=>false,'class'=>'form-control')); ?>
	<?php echo $this->Form->input('password_update',array('type'=>'password','label'=>false,'class'=>'form-control','placeholder'=>'New Password')); ?>
	<?php echo $this->Form->input('password_confirm',array('type'=>'password','label'=>false,'class'=>'form-control','placeholder'=>'Confirm password')); ?>
	<?php echo $this->Form->button('Update',array('class'=>'btn btn-lg btn-primary btn-block'));?>
	<?php echo $this->Form->end(); ?>
</div>