<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="<?php echo $this->Psd->frontend('siteurl'); ?>"><?php echo $this->Psd->frontend('sitename'); ?></a>
	</div>
	<div id="navbar" class="collapse navbar-collapse">
	  <ul class="nav navbar-nav navbar-right">
		<li><a href="<?php echo $this->Psd->frontend('siteurl'); ?>">Home</a></li>
		<?php
		
			$menu = $this->Psd->frontend('menu');
			
			foreach($menu as $item):
			
			?>
            <li><a href="<?php echo $this->Psd->frontend('siteurl'); ?>/page/<?php echo $item["Page"]["slug"]; ?>"><?php echo $item["Page"]["title"]; ?></a></li>
            <?php
			
			endforeach;
		
		?>
	  </ul>
	</div><!--/.nav-collapse -->
  </div>
</nav>