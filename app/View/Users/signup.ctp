<div class="container">
<?php echo $this->Form->create('User', array('action' => 'signup','class'=>'form-signin')); ?> 
    <h2 class="form-signin-heading text-center">Please sign up</h2>
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->Form->input('username',array('label'=>false,'class'=>'form-control','placeholder'=>'User name')); ?>
	<?php echo $this->Form->input('email',array('label'=>false,'class'=>'form-control','placeholder'=>'Email address')); ?>
	<?php echo $this->Form->input('password',array('type'=>'password','label'=>false,'class'=>'form-control','placeholder'=>'Password')); ?>
	<?php echo $this->Form->input('password_confirm',array('type'=>'password','label'=>false,'class'=>'form-control','placeholder'=>'Confirm password')); ?>
	<?php echo $this->Form->input('role',array('type'=>'hidden','label'=>false,'class'=>'form-control','value'=>'2')); ?>
	<?php echo $this->Form->button('Sign up',array('class'=>'btn btn-lg btn-primary btn-block'));?>
	<?php echo $this->Html->link(__('Or Already have an account?', true), array('controller' => 'users', 'action' => 'login'), array('class' => 'btn btn-block btn-link'));?>
	<?php echo $this->Form->end(); ?>
</div>