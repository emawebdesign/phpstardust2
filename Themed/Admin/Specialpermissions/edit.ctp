<div class="panel panel-default">
  <div class="panel-body">
  
  	<?php echo $this->Session->flash(); ?>
    
  	<h1><?php echo $this->Psd->text('Permissions'); ?> / <?php echo $this->Psd->text('Edit'); ?></h1>
    
    <div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
            <div class="panel panel-default panel-table">
            
                    <div class="panel-body">
                    
                    	<?php echo $this->Form->create($model); ?>
                        
                        <div class="form-group">
							<?php
                            
                            echo $this->Form->input('customrole_id',array(
								'autofocus'=>'autofocus',
                                'options' => $customroles,
                                'empty' => $this->Psd->text('Select'),
                                'label' => $this->Psd->text('Role'),
                                'class' => 'form-control input-lg'
                            ));
                            
                            ?>
                          </div>
                          
                         <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('plugin',array(
                                'id' => 'controller',
                                'placeholder' => $this->Psd->text('Enter') .' plugin',
                                'class' => 'form-control input-lg',
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                         <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('controller',array(
                                'id' => 'controller',
                                'placeholder' => $this->Psd->text('Enter') .' controller',
                                'class' => 'form-control input-lg',
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                         <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('action',array(
                                'id' => 'action',
                                'placeholder' => $this->Psd->text('Enter') .' action',
                                'class' => 'form-control input-lg',
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                         <div class="form-group">
							<?php
                            
                            echo $this->Form->input('permission',array(
                                'options' => array(
									'allow' => 'Allow',
									'deny' => 'Deny'
								),
                                'empty' => $this->Psd->text('Select'),
                                'label' => $this->Psd->text('Permission'),
                                'class' => 'form-control input-lg'
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
                          <?php
						  echo $this->Form->input('id', array('type' => 'hidden'));
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