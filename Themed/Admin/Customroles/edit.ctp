<div class="panel panel-default">
  <div class="panel-body">
  
  	<?php echo $this->Session->flash(); ?>
    
  	<h1><?php echo $this->Psd->text('Custom roles'); ?> / <?php echo $this->Psd->text('Edit'); ?></h1>
    
    <div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
            <div class="panel panel-default panel-table">
            
                    <div class="panel-body">
                    
                    	<?php echo $this->Form->create($model); ?>
                        
                        <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('name',array(
                                'id' => 'name',
								'autofocus'=>'autofocus',
                                'placeholder' => $this->Psd->text('Enter') .' name',
                                'class' => 'form-control input-lg',
								'label' => $this->Psd->text('Name'),
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                         <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('slug',array(
                                'id' => 'slug',
                                'placeholder' => $this->Psd->text('Enter') .' slug',
                                'class' => 'form-control input-lg',
								'label' => 'Slug',
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
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