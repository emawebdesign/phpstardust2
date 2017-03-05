<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="<?php echo Configure::read('Psd.url'); ?>/dashboard"><?php echo Configure::read('Psd.name'); ?></a>
	  <p class="navbar-text visible-lg visible-md"><?php echo Configure::read('Psd.subtitle'); ?></p>
      <a class="btn btn-adf navbar-btn" href="<?php echo Configure::read('Psd.url'); ?>" target="_blank" title="<?php echo $this->Psd->text('View'); ?>"><i class="fa fa-eye"></i></a>
	</div>
	<div id="navbar" class="collapse navbar-collapse">
	  <ul class="nav navbar-nav navbar-right">
		<li>
			<div class="btn-group">
			  <button class="btn btn-adf dropdown-toggle navbar-btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-user"></i> <?php echo $this->Psd->text('Hi'); ?>, <?php echo AuthComponent::user('username'); ?>
			  </button>
			  <ul class="dropdown-menu">
              	<li>
                <?php 
			
				echo $this->Html->link(
					'<i class="fa fa-pencil"></i> ' .$this->Psd->text('Edit profile'),
					array('plugin' => 'phpstardust', 'controller' => 'users', 'action' => 'edit', AuthComponent::user('id')),
					array('escape' => false)
				); 
				
				?>
                </li>
                <li>
					<?php 
                
                    echo $this->Html->link(
                        '<i class="fa fa-wrench"></i> ' .$this->Psd->text('Settings'),
                        array('plugin' => 'phpstardust', 'controller' => 'settings', 'action' => 'edit', 1),
                        array('escape' => false)
                    ); 
                    
                    ?>
                </li>
			  </ul>
			</div>
		</li>
		<li><a href="<?php echo Configure::read('Psd.url'); ?>/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
	  </ul>
	</div><!--/.nav-collapse -->
  </div>
</nav>