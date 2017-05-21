<?php echo $this->element('navbar'); ?>

<?php echo $this->element('header'); ?>

<div class="container-fluid">

	<div class="row main">
	
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		
        	<?php if (isset($row)) { ?>
			<div class="panel panel-default">
			  <div class="panel-body">
				<h2><?php echo $row[$model]["title"]; ?></h2>
				<p><small><?php echo $this->Psd->frontend('created', $row[$model]["created"]); ?></small></p>
				<p class="tags">
                <?php
                	
					$tags = $this->Psd->frontend('tags', $row[$model]["id"]);
			
					foreach($tags as $item):
					
						echo '<a href="' .$this->Psd->frontend('siteurl') .'?q=' .$item .'"><span class="label label-default">' .$item .'</span></a> ';
					
					endforeach;
				?>
				</p>
				  
				<?php if ($row[$model]["image"]!="") { ?>
				<img src="<?php echo $this->Psd->frontend('image', $row[$model]["id"], $model); ?>" alt="<?php echo $row[$model]["title"]; ?>" class="img-responsive">
                		<?php } ?>
				  
                		<?php echo $row[$model]["text"]; ?>
                
				<hr>
				<p class="pull-left"><?php echo $this->Psd->frontend('author', $row[$model]["user_id"]); ?><br /><?php echo $this->Psd->text('Category:') .' ' .$this->Psd->frontend('category', $row[$model]["categorie_id"]); ?></p>
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
