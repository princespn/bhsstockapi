<div class="container">
<?php echo $this->Form->create('User', array('action' => 'login','class'=>'form-signin')); ?> 
    <h2 class="form-signin-heading text-center">Please sign in</h2>
    <?php echo $this->Session->flash(); ?>
	<?php echo $this->Form->input('username',array('label'=>false,'class'=>'form-control','placeholder'=>'User name')); ?>
	<?php echo $this->Form->input('password',array('label'=>false,'class'=>'form-control','placeholder'=>'Password')); ?>
	<?php echo $this->Form->input('remember_me', array('label' => 'Remember me', 'type' => 'checkbox','class'=>'checkbox')); ?>
	<?php echo $this->Form->button('Sign in',array('class'=>'btn btn-lg btn-primary btn-block'));?>
<a class="btn btn-block btn-link" href="/users/signup/">Or create an account</a>
<?php echo $this->Form->end(); ?>
</div>
<script>
            $(function() {
 
                if (localStorage.chkbx && localStorage.chkbx != '') {
                    $('#UserRememberMe').attr('checked', 'checked');
                    $('#UserUsername').val(localStorage.username);
                    $('#UserPassword').val(localStorage.password);
                } else {
                    $('#UserRememberMe').removeAttr('checked');
                    $('#UserUsername').val('');
                    $('#UserPassword').val('');
                }
 
                $('#UserRememberMe').click(function() {
 
                    if ($('#UserRememberMe').is(':checked')) {
                        // save username and password
                        localStorage.username = $('#UserUsername').val();
                        localStorage.password = $('#UserPassword').val();
                        localStorage.chkbx = $('#UserRememberMe').val();
                    } else {
                        localStorage.username = '';
                        localStorage.password = '';
                        localStorage.chkbx = '';
                    }
                });
            });
 
        </script>