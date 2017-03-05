<div class="panel panel-default">
  <div class="panel-body">
  
  	<?php echo $this->Session->flash(); ?>
    
  	<h1><?php echo $this->Psd->text(Inflector::pluralize($model)); ?> / <?php echo $this->Psd->text('Import DB'); ?></h1>
    
    <div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
            <div class="panel panel-default panel-table">
            
                    <div class="panel-body">
                    
                    	<?php echo $this->Form->create($model, array('type' => 'file')); ?>
                          
                          <div class="form-group">
							<?php
                            
                            echo $this->Form->input('file', array(
                                'label' => $this->Psd->text('Choose SQL file.'),
                                'type' => 'file',
                                'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
                          <?php
						  echo $this->Form->button($this->Psd->text('Import DB'), array(
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