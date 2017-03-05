<?php echo $this->element('navbar'); ?>

<?php echo $this->element('header'); ?>

<div class="container-fluid">

	<div class="row main">
	
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		
        	<div class="panel panel-default">
            	<div class="panel-body">
                	<h2>Error 404</h2>
                	<p><?php echo $message; ?></p>
                </div>
            </div>
		
		</div>
		
		<?php echo $this->element('sidebar'); ?>
	
	</div>

</div><!-- end container-fluid -->

<?php echo $this->element('footer'); ?>