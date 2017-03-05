<div class="panel panel-default">
  <div class="panel-body">
  
  	<?php echo $this->Session->flash(); ?>
    
  	<h1><?php echo $this->Psd->text(Inflector::pluralize($model)); ?> / <?php echo $this->Psd->text('Add'); ?></h1>
    
    <div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
            <div class="panel panel-default panel-table">
            
                    <div class="panel-body">
                    
                    	<?php echo $this->Form->create($model, array('type' => 'file')); ?>
                        
                        <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('title',array(
                                'id' => 'title',
								'autofocus'=>'autofocus',
                                'placeholder' => $this->Psd->text('Enter') .' title',
                                'class' => 'form-control input-lg',
								'label' => $this->Psd->text('Title') .' - SEO Tips: Max 60 ' .$this->Psd->text('characters'),
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('description',array(
                                'id' => 'description',
								'type'=>'textarea',
								'rows' => 3,
                                'placeholder' => $this->Psd->text('Enter') .' description',
                                'class' => 'form-control input-lg',
								'label' => $this->Psd->text('Description') .' - SEO Tips: Max 160 ' .$this->Psd->text('characters'),
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
							<?php
                            
                            echo $this->Form->input('image', array(
                                'label' => $this->Psd->text('Image') .' (' .Configure::read('Psd.imageTypesAccepted') .')',
                                'type' => 'file',
                                'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
							<?php
                            
                            echo $this->Form->input('categorie_id',array(
                                'options' => $categories,
                                'empty' => $this->Psd->text('Select'),
                                'label' => $this->Psd->text('Category'),
                                'class' => 'form-control input-lg'
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('tags',array(
                                'id' => 'tags',
								'type' => 'text',
                                'placeholder' => $this->Psd->text('Enter') .' tags',
                                'class' => 'form-control input-lg',
								'label' => 'Tags',
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
							<?php
                                    
                            echo $this->Form->input('text',array(
                                'id' => 'text',
								'type'=>'textarea',
								'rows' => 3,
                                'placeholder' => $this->Psd->text('Enter') .' text',
                                'class' => 'form-control input-lg summernote',
								'label' => $this->Psd->text('Text'),
								'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
                            <label for="date">Date</label>
                            <div class='input-group date' id='created'>
                                <input type='text' class="form-control" name="data[<?php echo $model; ?>][created]" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#created').datetimepicker({
                                        locale: '<?php echo $this->Psd->getLanguage(); ?>',
                                        sideBySide: true,
                                        format: "YYYY-MM-DD HH:mm:ss"
                                    });
                                });
                            </script>
                          </div>
                          
                          <div class="form-group">
							<?php
                            
                            echo $this->Form->input('status',array(
                                'options' => array(
									'draft' => $this->Psd->text('Draft'), 
									'published' => $this->Psd->text('Published')
								),
                                'empty' => $this->Psd->text('Select'),
                                'label' => $this->Psd->text('Status'),
                                'class' => 'form-control input-lg'
                            ));
                            
                            ?>
                          </div>
                          
                          <div class="form-group">
                          
                          	<div class="panel panel-default">
                              <div class="panel-heading paneltop">SEO</div>
                              <div class="panel-body">
                              
                              	 <div class="form-group">
                                     <div class="checkbox checkbox-success">
                                        <?php
                                        echo $this->Form->checkbox('noindex', array(
                                            'value' => 1,
                                            'hiddenField' => 'N',
                                            'id' => 'noindex',
                                            'class' => 'styled',
                                            'type' => 'checkbox'
                                        ));
                                        ?>
                                        <label for="noindex">
                                            Meta noindex
                                        </label>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                     <div class="checkbox checkbox-success">
                                        <?php
                                        echo $this->Form->checkbox('nofollow', array(
                                            'value' => 1,
                                            'hiddenField' => 'N',
                                            'id' => 'nofollow',
                                            'class' => 'styled',
                                            'type' => 'checkbox'
                                        ));
                                        ?>
                                        <label for="nofollow">
                                            Meta nofollow
                                        </label>
                                      </div>
                                  </div>
                                  
                              </div>
                            </div>
                          
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