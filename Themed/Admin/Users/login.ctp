<div class="panel panel-default">
  <div class="panel-body">
  
  	<h1><?php echo $this->Psd->text('Login'); ?></h1>
  
	<?php echo $this->Form->create($model, array('url' => '/login')); ?>
	  <div class="form-group">
      	<?php
                
		echo $this->Form->input('username',array(
			'autofocus'=>'autofocus',
			'id' => 'username',
			'placeholder' => $this->Psd->text('Enter') .' username',
			'class' => 'form-control input-lg'
		));
		
		?>
	  </div>
	  <div class="form-group">
		<?php
                
		echo $this->Form->input('password',array(
			'id' => 'password',
			'placeholder' => $this->Psd->text('Enter') .' password',
			'class' => 'form-control input-lg'
		));
		
		?>
	  </div>
      <div class="checkbox checkbox-success">
        <?php
		echo $this->Form->checkbox('remember', array(
			'value' => 1,
			'hiddenField' => 'N',
			'id' => 'remember',
			'class' => 'styled',
			'type' => 'checkbox'
		));
		?>
		<label for="remember">
			<?php echo $this->Psd->text('Remember me'); ?>
		</label>
	  </div>
      <?php
	  echo $this->Form->button('<i class="fa fa-check"></i> ' .$this->Psd->text('Login'),array(
		  'type'=>'submit',
		  'class'=>'btn btn-adf btn-lg'
	  ));
	  ?>
	<?php echo $this->Form->end(); ?>
  
  </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <?php
            echo $this->Html->link(
                $this->Psd->text('Forgot password?'),
                '/forgot-password',
                array('class' => 'text-adf')
            );
            ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
            <?php
            echo $this->Html->link(
                $this->Psd->text('Sign Up'),
                '/register',
                array('class' => 'text-adf')
            );
            ?>
        </div>
    </div>
</div>