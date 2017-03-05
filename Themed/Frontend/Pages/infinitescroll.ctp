<?php echo $this->element('navbar'); ?>

<?php echo $this->element('header'); ?>

<div class="container-fluid">

	<div class="row main">
	
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

			<div class="panel panel-default">
			  <div class="panel-body" id="infiniteContent"></div>
			</div>
		
		</div>
		
		<?php echo $this->element('sidebar'); ?>
	
	</div>

</div><!-- end container-fluid -->

<?php echo $this->element('footer'); ?>

<script>

<?php $infiniteUrl = Configure::read('Psd.url') .'/phpstardust/' .$this->params["controller"] ."/infiniteloader"; ?>
infiniteScroll('<?php echo $infiniteUrl; ?>', <?php echo $maxPage; ?>, '#q', '<?php echo $this->Psd->text('No data.'); ?>');

</script>