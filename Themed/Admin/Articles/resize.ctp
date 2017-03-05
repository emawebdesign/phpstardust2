<div class="panel panel-default">
  <div class="panel-body">
  
  	<?php echo $this->Session->flash(); ?>
    
  	<h1><?php echo $this->Psd->text('Image'); ?> / <?php echo $this->Psd->text('Resize'); ?></h1>
    
    <div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
            <div class="panel panel-default panel-table">
            
                    <div class="panel-body">
                    
                    	<?php echo $this->Form->create($model); ?>
                        
                        <div class="form-group">
                        	<label><?php echo $this->Psd->text('Sizes'); ?></label>
                            <p><?php echo $sizes; ?></p>
                        </div>
                        
                    
                        <div class="form-group">
                          <?php
                                  
                          echo $this->Form->input('size',array(
                              'id' => 'size',
                              'placeholder' => $this->Psd->text('Enter') .' ' .$this->Psd->text('Size'),
                              'class' => 'form-control input-lg',
                              'label' => $this->Psd->text('New Size') .' (w)',
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