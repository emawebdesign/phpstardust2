<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo Configure::read('Psd.name'); ?></title>

    <?php echo $this->Html->css('assets/bootstrap-3.3.7/css/bootstrap.min.css') ."\r\n"; ?>
    <?php echo $this->Html->css('assets/font-awesome-4.7.0/css/font-awesome.min.css') ."\r\n"; ?>
    <?php echo $this->Html->css('assets/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') ."\r\n"; ?>
    <?php echo $this->Html->css('assets/plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') ."\r\n"; ?>
    <?php echo $this->Html->css('assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') ."\r\n"; ?>
    <?php echo $this->Html->css('assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css') ."\r\n"; ?>
    <?php echo $this->Html->css('assets/plugins/dropzone/dist/min/dropzone.min.css') ."\r\n"; ?>
    <?php echo $this->Html->css('assets/plugins/summernote/dist/summernote.css') ."\r\n"; ?>
    <?php echo $this->Html->css('assets/plugins/jcrop/css/jquery.Jcrop.min.css') ."\r\n"; ?>
    <?php echo $this->Html->css('assets/css/style.css') ."\r\n"; ?>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


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
    <?php echo $this->Html->script('assets/plugins/Chart.bundle.min.js') ."\r\n"; ?>
    <?php echo $this->Html->script('assets/plugins/dropzone/dist/min/dropzone.min.js') ."\r\n"; ?>
    <?php echo $this->Html->script('assets/js/core.js') ."\r\n"; ?>
  
  
  	<?php echo $this->element('navbar'); ?>
    
    
    <?php echo $this->element('topmenu'); ?>
    
    
    <?php echo $this->element('breadcrumbs'); ?>
    
    
    
    
    <div class="container-fluid">
    
    	<div class="row">
        
        	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            
            	<?php echo $this->element('menu'); ?>
            
            </div>
            
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            
            	<?php echo $this->fetch('content'); ?>
            
            </div>
        
        </div>
    
    </div>
    
    
    
    
    <?php echo $this->element('footer'); ?>

  


    <?php echo $this->Html->script('assets/plugins/moment-with-locales.js') ."\r\n"; ?>
    <?php echo $this->Html->script('assets/plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') ."\r\n"; ?>
    <?php echo $this->Html->script('assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') ."\r\n"; ?>
    <?php echo $this->Html->script('assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js') ."\r\n"; ?>
    <?php echo $this->Html->script('assets/plugins/summernote/dist/summernote.min.js') ."\r\n"; ?>
    <?php echo $this->Html->script('assets/plugins/jcrop/js/jquery.Jcrop.min.js') ."\r\n"; ?>
    
  </body>
</html>