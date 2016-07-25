<div class="container">
<?php echo $this->Form->create('User', array('action' => 'reset_password_token','class'=>'form-signin', 'id' => 'web-form')); ?> 
    <h2 class="form-signin-heading text-center">Change password</h2>
    <?php echo $this->Session->flash(); ?>
	<?php echo $this->Form->hidden('User.reset_password_token'); ?>
	<?php echo $this->Form->input('User.new_passwd',array('type' => 'password','label'=>false,'class'=>'form-control','placeholder'=>'New Password')); ?>
	<?php echo $this->Form->input('User.confirm_passwd',array('type' => 'password','label'=>false,'class'=>'form-control','placeholder'=>'Confirm Password')); ?>
	<?php echo $this->Form->button('Change Password',array('class'=>'btn btn-lg btn-primary btn-block', 'id' => 'submit'));?>
<?php echo $this->Form->end(); ?>
</div>
