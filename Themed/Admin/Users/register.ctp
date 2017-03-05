<div class="panel panel-default">
  <div class="panel-body">
  
  	<h1><?php echo $this->Psd->text('Registration'); ?></h1>
  
	<?php echo $this->Form->create($model, array('url' => '/register')); ?>

	  <div class="form-group">
      	<?php
                
		echo $this->Form->input('email',array(
			'autofocus'=>'autofocus',
			'placeholder' => $this->Psd->text('Enter') .' email',
			'class' => 'form-control input-lg',
			'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
		));
		
		?>
	  </div>
      <div class="form-group">
		<?php
        
        echo $this->Form->input('username',array(
            'placeholder' => $this->Psd->text('Enter') .' username',
            'class' => 'form-control input-lg',
            'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
        ));
        
        ?>
      </div>
      <div class="form-group">
        <?php
        
        echo $this->Form->input('password',array(
            'type' => 'password',
            'placeholder' => $this->Psd->text('Enter') .' password',
            'class' => 'form-control input-lg',
            'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
        ));
        
        ?>
	  </div>
      <div class="checkbox checkbox-success">
        <?php
		echo $this->Form->checkbox('accept', array(
			  'value' => 1,
			  'hiddenField' => 'N',
			  'id' => 'accept',
			  'class' => 'styled',
			  'type' => 'checkbox'
		  ));
		?>
		<label for="accept">
			<?php echo $this->Psd->text('Accept ToS and Privacy policy.'); ?>
		</label>
        <?php echo $this->Form->error('accept', null, array('class' => 'error-message alert alert-warning')); ?>
	  </div>
      <?php
	  echo $this->Form->input('role', array('type'=>'hidden', 'value'=>'user'));
	  echo $this->Form->button('<i class="fa fa-pencil"></i> ' .$this->Psd->text('Sign Up'),array(
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