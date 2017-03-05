<div class="panel panel-default">
  <div class="panel-body">
  
  	<?php echo $this->Session->flash(); ?>
  
  	<h1><?php echo $this->Psd->text('Custom roles'); ?> <span class="badge"><?php echo $count; ?></span></h1>
    
    <div class="row">
	  
		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			  <?php 
			  echo $this->Html->link(
				  '<i class="fa fa-plus"></i> ' .$this->Psd->text('Add'),
				  array('plugin' => 'phpstardust', 'controller' => Inflector::tableize($model), 'action' => 'add'),
				  array('class'=>'btn btn-adf', 'escape' => false)
			  ); 
			  ?>
		  </div>
		  
		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
			  <?php echo $this->Form->create($model, array('url' => 'index', 'class' => 'navbar-form searchform', 'role' => 'search', 'type' => 'get')); ?>
			  <div class="input-group searchbox">
                  <?php
				  
                  echo $this->Form->input('q',array(
						'type'=>'text',
						'autofocus'=>'autofocus',
						'label'=>false,
						'div'=>false,
						'class' => 'form-control',
						'placeholder' => $this->Psd->text('Search')
					));
				  
					?>
				  <div class="input-group-btn">
                      <?php
					  echo $this->Form->button('<i class="fa fa-search"></i> ' .$this->Psd->text('Search'),array(
							'type'=>'submit',
							'class' => 'btn btn-adf'
						));
						?>
				  </div>
			  </div>
              <?php echo $this->Form->end(); ?>
		  </div>
		  
	</div>
    
    <?php if (count($rows)>0) { ?>
    <div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
            <div class="panel panel-default panel-table">
            
                    <div class="panel-body">
                    
                    	<div class="table-responsive">
                            <table class="table table-striped"> 
                                <thead> 
                                    <tr> 
                                        <th>#</th> 
                                        <th><?php echo $this->Psd->text('Name'); ?></th>
                                        <th><?php echo $this->Psd->text('Actions'); ?></th> 
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    <?php foreach ($rows as $row): ?>
                                    <tr> 
                                        <th scope="row"><?php echo $row[$model]['id']; ?></th> 
                                        <td><?php echo $row[$model]['name']; ?></td>
                                        <td>
                                            <?php 
                                              echo $this->Html->link(
                                                  '<i class="fa fa-pencil"></i> ',
                                                  array('action' => 'edit', $row[$model]['id']),
                                                  array('class'=>'btn btn-adf btn-sm', 'escape' => false)
                                              ); 
                                            ?>
                                            <?php
                                                  echo $this->Form->postLink(
                                                      '<i class="fa fa-remove"></i> ',
                                                      array('action' => 'delete', $row[$model]['id']),
                                                      array('class'=>'btn btn-danger btn-sm', 'escape' => false, 'confirm' => $this->Psd->text('Are you sure?'))
                                                  );
                                              ?>
                                        </td> 
                                    </tr>  
                                    <?php endforeach; ?>
                                </tbody> 
                            </table>
                        </div>
                    
                    </div>
                
            </div>
            
        </div>
    
    </div>
    
    <div class="row">
    
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        	<?php echo $this->element('pagination'); ?>
        
        </div>
    
    </div>
    <?php } else { ?>
    
    <div class="row">
    
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        	<div class="panel panel-default panel-table">
                <div class="panel-body">
                	<p><?php echo $this->Psd->text('No data.'); ?></p>
                </div>
            </div>
        
        </div>
    
    </div>
    
    <?php } ?>
  
  </div>
</div>