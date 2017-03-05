<div class="container-fluid footer text-center">

	<div class="row">
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<ul class="list-unstyled list-inline">
				<li><a href="<?php echo $this->Psd->frontend('siteurl'); ?>/feed"><i class="fa fa-rss"></i></a></li>
				<?php $social = $this->Psd->frontend('social'); ?>
                <?php if ($social["Setting"]["facebook_profile"]!="") { ?>
                <li><a href="<?php echo $social["Setting"]["facebook_profile"]; ?>"><i class="fa fa-facebook"></i></a></li>
                <?php } ?>
                <?php if ($social["Setting"]["googleplus_profile"]!="") { ?>
				<li><a href="<?php echo $social["Setting"]["googleplus_profile"]; ?>"><i class="fa fa-google-plus"></i></a></li>
                <?php } ?>
                <?php if ($social["Setting"]["instagram_profile"]!="") { ?>
				<li><a href="<?php echo $social["Setting"]["instagram_profile"]; ?>"><i class="fa fa-instagram"></i></a></li>
                <?php } ?>
                <?php if ($social["Setting"]["linkedin_profile"]!="") { ?>
				<li><a href="<?php echo $social["Setting"]["linkedin_profile"]; ?>"><i class="fa fa-linkedin"></i></a></li>
                <?php } ?>
                <?php if ($social["Setting"]["twitter_profile"]!="") { ?>
				<li><a href="<?php echo $social["Setting"]["twitter_profile"]; ?>"><i class="fa fa-twitter"></i></a></li>
                <?php } ?>
                <?php if ($social["Setting"]["youtube_profile"]!="") { ?>
				<li><a href="<?php echo $social["Setting"]["youtube_profile"]; ?>"><i class="fa fa-youtube"></i></a></li>
                <?php } ?>
			</ul>
		
			<p><?php echo $this->Psd->frontend('sitename') .' - ' .$this->Psd->text('built with'); ?> <a href="http://www.phpstardust.org">Phpstardust.org</a></p>
		
		</div>
	
	</div>

</div><!-- end container-fluid -->