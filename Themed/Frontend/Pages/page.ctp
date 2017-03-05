<?php echo $this->element('navbar'); ?>

<?php echo $this->element('header'); ?>

<div class="container-fluid">

	<div class="row main">
	
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		
        	<?php if (isset($row)) { ?>
			<div class="panel panel-default">
			  <div class="panel-body">
				<h2><?php echo $row[$model]["title"]; ?></h2>
				<img src="<?php echo $this->Psd->frontend('image', $row[$model]["id"], $model); ?>" alt="<?php echo $row[$model]["title"]; ?>" class="img-responsive">
                
                <?php echo $row[$model]["text"]; ?>
                
			  </div>
			</div>
            
            <?php } else { ?>
            <div class="panel panel-default">
            	<div class="panel-body">
                	<p><?php echo $this->Psd->text('No data.'); ?></p>
                </div>
            </div>
            <?php } ?>
		
		</div>
		
		<?php echo $this->element('sidebar'); ?>
	
	</div>

</div><!-- end container-fluid -->

<?php echo $this->element('footer'); ?>