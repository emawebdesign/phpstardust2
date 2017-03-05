<div class="panel panel-default">
  <div class="panel-body">
  
  	<h1><?php echo $this->Psd->text('Retrieve password'); ?></h1>
  
	<?php echo $this->Form->create($model, array('url' => '/forgot-password')); ?>

	  <div class="form-group">
      	<?php
                
		echo $this->Form->input('email',array(
			'autofocus'=>'autofocus',
			'placeholder' => $this->Psd->text('Enter') .' email',
			'class' => 'form-control input-lg',
			'label' => $this->Psd->text('Forgot password?')
		));
		
		?>
	  </div>
      <?php
	  echo $this->Form->button('<i class="fa fa-envelope"></i> ' .$this->Psd->text('Send me a new password'),array(
		  'type'=>'submit',
		  'class'=>'btn btn-adf btn-lg'
	  ));
	  ?>
	<?php echo $this->Form->end(); ?>
  
  </div>
</div>

<div class="container-fluid">
    <div class="row text-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
            echo $this->Html->link(
                $this->Psd->text('Go to login'),
                '/login',
                array('class' => 'text-adf')
            );
            ?>
        </div>
    </div>
</div>