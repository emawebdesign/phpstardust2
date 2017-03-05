<div class="container-fluid breadcrumbs">
    
	<div class="row">
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<ol class="breadcrumb">
            
              <?php if ($this->params["action"]!="dashboard") { ?>
              
			  <li><i class="fa fa-home"></i> <?php echo $this->Html->link(
					'Dashboard',
					'/dashboard'
				); ?></li>
                
              <?php } ?>
                
              <?php if ($this->params["controller"]!="settings" && $this->params["action"]!="dashboard") { ?>
              
      			<li><a href="<?php echo Configure::read('Psd.url'); ?>/phpstardust/<?php echo $this->params["controller"]; ?>">
				<?php echo Inflector::humanize($this->params["controller"]); ?>
                </a></li>
                
      		  <?php } ?>
              
			  <li class="active">
              	<?php if ($this->params["action"]=="dashboard") echo '<i class="fa fa-home"></i>'; ?>
			  	<?php echo __d('phpstardust', Inflector::humanize($this->params["action"])); ?>
              </li>
              
			</ol>
		
		</div>
	
	</div>

</div>