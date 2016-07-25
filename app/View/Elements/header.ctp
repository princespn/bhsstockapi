<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
      	<span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <?php echo $this->Html->link( "Homescapes",array('controller' => 'stocks','action'=>'index'),array('class'=>'navbar-brand')); ?>
      </div>
    <div class="navbar-collapse collapse" id="navbar">
      <ul class="nav navbar-nav navbar-right">
 <?php  if((AuthComponent::user('role'))=='1'){ ?>
 <li><?php echo $this->Html->link( "Users",array('controller' => 'users','action'=>'index')); ?></li>
<li><?php echo $this->Html->link('Logout',array('controller' => 'users','action'=>'logout')); ?></li>
<?php }else if($this->Session->check('Auth.User')){ ?>
<li><?php echo $this->Html->link( "Home",array('action'=>'index')); ?></li>
<li><?php echo $this->Html->link( "Logout",   array('controller' => 'users','action'=>'logout') ); ?></li>
<?php }else{ ?>       
<?php } ?>
 </ul>
    </div>
  </div>
</nav>