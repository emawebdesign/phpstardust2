<!DOCTYPE html>
<?php echo $this->Psd->html(); ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->Psd->getTitle($metaTitle); ?></title>
    <?php echo $this->Psd->getDescription($metaDescription); ?>
    
    <?php echo $this->Psd->opengraph($opengraph); ?>
    
    <?php echo $this->Psd->robots($robots); ?>

    <?php echo $this->Html->css('assets/bootstrap-3.3.7/css/bootstrap.min.css') ."\r\n"; ?>
    <?php echo $this->Html->css('assets/font-awesome-4.7.0/css/font-awesome.min.css') ."\r\n"; ?>
    <?php echo $this->Html->css('assets/css/style.css') ."\r\n"; ?>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
  	<?php echo $this->Html->script('assets/js/jquery.min.js') ."\r\n"; ?>
    <?php echo $this->Html->script('assets/bootstrap-3.3.7/js/bootstrap.min.js') ."\r\n"; ?>
    <?php echo $this->Html->script('assets/js/core.js') ."\r\n"; ?>
    
  	<?php echo $this->fetch('content'); ?>
	
    <?php
	if (isset($error404) && $error404) {
		header("HTTP/1.0 404 Not Found");
		exit;
	}
	?>
    
  </body>
</html>
