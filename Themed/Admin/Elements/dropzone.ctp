<div class="panel panel-default panel-table">
            
    <div class="panel-heading paneltop"><?php echo $this->Psd->text('Image'); ?></div>
    
    <div class="panel-body">
        <?php
		echo $this->Form->create(false, array(
			'url' => Configure::read('Psd.url') .'/upload',
			'type' => 'post',
			'class' => 'dropzone',
			'id' => 'uploadFile'
		));
		?>
            <div class="dz-message" data-dz-message><span><?php echo $this->Psd->text('Drop files here to upload'); ?></span></div>
            <?php echo $this->Form->input('model', array('type' => 'hidden', 'value' => $model)); ?>
            <?php echo $this->Form->input('field', array('type' => 'hidden', 'value' => $field)); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->data[$model]["id"])); ?>
        <?php echo $this->Form->end(); ?>
    </div>
    
    <div class="panel-body">
        <div class="row" id="images">
        
        	<?php if ($this->data[$model]["image"]!="") { ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            
            	<a href="<?php echo Configure::read('Psd.url'); ?>/files/uploads/<?php echo $this->data[$model]["image"]; ?>" class="thumbnail" target="_blank"><img class="img-responsive" src="<?php echo Configure::read('Psd.url'); ?>/files/uploads/<?php echo $this->data[$model]["image"]; ?>"></a>
                
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            
            	<a href="javascript:deleteImage('<?php echo Configure::read('Psd.url'); ?>/delete-image/<?php echo $model ."/" .$this->data[$model]["id"]; ?>', '<?php echo $this->Psd->text('Are you sure?'); ?>');" class="btn btn-adf btn-block"><?php echo $this->Psd->text('Delete'); ?></a>
                <div class="alert alert-warning hidden" role="alert" style="margin-top:20px">Wait...</div>
                
            </div>
            <?php } ?>
        
        </div>
    </div>
    
    <script>
    
    Dropzone.autoDiscover = false;
    
    $(function() {
        
      var myDropzone = new Dropzone("#uploadFile", { 
	  	url: "<?php echo Configure::read('Psd.url'); ?>/upload",
		acceptedFiles: "<?php echo Configure::read('Psd.imageTypesAccepted'); ?>"
	  });
	  
      myDropzone.on("success", function(file, response) {
                  
        if (response!="ko") {
        
            var html = '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
            html += '<a href="<?php echo Configure::read('Psd.url'); ?>/files/uploads/' + response + '" class="thumbnail" target="_blank">';
              html += '<img class="img-responsive" src="<?php echo Configure::read('Psd.url'); ?>/files/uploads/' + response + '">';
            html += '</a>';
          html += '</div>';
          html += '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
            html += '<a href="javascript:deleteImage(\'<?php echo Configure::read('Psd.url'); ?>/delete-image/<?php echo $model ."/" .$this->data[$model]["id"]; ?>\', \'<?php echo $this->Psd->text('Are you sure?'); ?>\');" class="btn btn-adf btn-block"><?php echo $this->Psd->text('Delete'); ?></a>';
			html += '<div class="alert alert-warning hidden" role="alert" style="margin-top:20px">Wait...</div>';
          html += '</div>';
          
          $('#images').html(html);
            
        }
        
      });
          

      
    });
    
    </script>

</div>