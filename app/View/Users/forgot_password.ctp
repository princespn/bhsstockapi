<div class="container">
<?php echo $this->Form->create('User', array('action' => 'forgot_password','class'=>'form-signin','id' => 'web-form')); ?> 
    <h2 class="form-signin-heading text-center">Enter user name</h2>
    <?php echo $this->Session->flash(); ?>
	<?php echo $this->Form->input('User.username',array('label'=>false,'class'=>'form-control','placeholder'=>'User name')); ?>
	<?php echo $this->Form->button('Send forgot password',array('class'=>'btn btn-lg btn-primary btn-block','id' => 'submit'));?>
	<?php echo $this->Form->end(); ?>
</div>
