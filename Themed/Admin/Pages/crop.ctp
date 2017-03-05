<div class="panel panel-default">
  <div class="panel-body">
  
  	<?php echo $this->Session->flash(); ?>
    
  	<h1><?php echo $this->Psd->text('Image'); ?> / <?php echo $this->Psd->text('Crop'); ?></h1>
    
    <div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
            <div class="panel panel-default panel-table">
            
                    <div class="panel-body">
                    
                    	<?php echo $this->Form->create($model, array('type' => 'file', 'onsubmit' => 'return checkCoords();')); ?>
                        
                        <div class="form-group">
							<?php echo $this->Html->image(Configure::read('Psd.url') ."/files/uploads/" .$this->data[$model]["image"], array('id' => 'crop')); ?>
                        </div>
                        <script language="Javascript">

						$(function(){
			
							$('#crop').Jcrop({
								aspectRatio: 1,
								onSelect: updateCoords
							});
			
						});
			
						function updateCoords(c)
						{
							$('#x').val(c.x);
							$('#y').val(c.y);
							$('#w').val(c.w);
							$('#h').val(c.h);
						};
			
						function checkCoords()
						{
							if (parseInt($('#w').val())) return true;
							alert('<?php echo $this->Psd->text('Please select a crop region then press submit.'); ?>');
							return false;
						};
			
					</script>
                    
                    <div class="form-group">
					  <?php
                              
                      echo $this->Form->input('size',array(
                          'id' => 'size',
                          'placeholder' => $this->Psd->text('Enter') .' ' .$this->Psd->text('Size'),
                          'class' => 'form-control input-lg',
                          'label' => $this->Psd->text('New Size') .' (w = h)',
                          'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                      ));
                      
                      ?>
                    </div>
                          
                        <div class="form-group">
                        <?php
                        echo $this->Form->input('id', array('type' => 'hidden'));
						echo $this->Form->input('x', array('type' => 'hidden', 'id' => 'x'));
						echo $this->Form->input('y', array('type' => 'hidden', 'id' => 'y'));
						echo $this->Form->input('w', array('type' => 'hidden', 'id' => 'w'));
						echo $this->Form->input('h', array('type' => 'hidden', 'id' => 'h'));
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