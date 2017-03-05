<div class="panel panel-default">
  <div class="panel-body">
  
  	<?php echo $this->Session->flash(); ?>
    
  	<h1><?php echo $this->Psd->text(Inflector::pluralize($model)); ?> / <?php echo $this->Psd->text('Add'); ?></h1>
    
    <div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
            <div class="panel panel-default panel-table">
            
                    <div class="panel-body">
                    
                    	<?php echo $this->Form->create($model); ?>
                        
                        <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('email',array(
                                'autofocus'=>'autofocus',
                                'id' => 'email',
                                'placeholder' => $this->Psd->text('Enter') .' email',
                                'class' => 'form-control input-lg',
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('username',array(
                                'id' => 'username',
                                'placeholder' => $this->Psd->text('Enter') .' username',
                                'class' => 'form-control input-lg',
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('password',array(
                                'id' => 'password',
								'type' => 'password',
								'value' => '',
                                'placeholder' => $this->Psd->text('Enter') .' password',
                                'class' => 'form-control input-lg',
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
							<?php
                            
                            echo $this->Form->input('role',array(
                                'options' => $roles,
                                'empty' => $this->Psd->text('Select'),
                                'label' => $this->Psd->text('Role'),
                                'class' => 'form-control input-lg'
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
							<?php
                            
                            echo $this->Form->input('status',array(
                                'options' => array(
									0 => $this->Psd->text('Inactive'), 
									1 => $this->Psd->text('Active')
								),
                                'empty' => $this->Psd->text('Select'),
                                'label' => $this->Psd->text('Status'),
                                'class' => 'form-control input-lg'
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
                          <?php
						  echo $this->Form->button($this->Psd->text('Save'), array(
							  'type'=>'submit',
							  'class'=>'btn btn-adf btn-lg'
						  ));
						  ?>
                          </div>
                        
                        <?php echo $this->Form->end(); ?>
                    
                    </div>
                
            </div>
            
        </div>
    
    </div>
  
  </div>
</div>