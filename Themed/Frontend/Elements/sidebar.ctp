<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 sidebar">
		
    <div class="panel panel-default">
    
        <div class="panel-body">
        
            <?php
			echo $this->Form->create(false, array(
				'url' => $this->Psd->frontend('siteurl'),
				'type' => 'get',
				'role' => 'search'
			));
			?>
              <div class="form-group">
                <?php
				  
				echo $this->Form->input('q',array(
					  'id' => 'q',
					  'type'=>'text',
					  'label'=>false,
					  'div'=>false,
					  'class' => 'form-control input-lg',
					  'placeholder' => $this->Psd->text('Search')
				  ));
				
				  ?>
              </div>
              <?php
			  echo $this->Form->button($this->Psd->text('Search'),array(
					'type'=>'submit',
					'class' => 'btn btn-bootb btn-lg'
				));
			   ?>
            </form>
        
        </div>
    
    </div>
    
    <div class="panel panel-default">
      <div class="panel-body">
        <h4>Latest Posts</h4>
      </div>
      <ul class="list-group">
      	<?php $latest = $this->Psd->frontend('latest'); ?>
        <?php foreach($latest as $item): ?>
        <li class="list-group-item">
            <a href="<?php echo $this->Psd->frontend('siteurl'); ?>/post/<?php echo $item["Article"]["slug"]; ?>"><i class="fa fa-chevron-right"></i> <?php echo $item["Article"]["title"]; ?></a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
    
    
    
    <div class="panel panel-default">
      <div class="panel-body">
        <h4>Categories</h4>
      </div>
      <ul class="list-group">
      	<?php $categories = $this->Psd->frontend('categories'); ?>
        <?php foreach($categories as $item): ?>
        <li class="list-group-item">
            <a href="<?php echo $this->Psd->frontend('siteurl'); ?>/category/<?php echo $item["Categorie"]["slug"]; ?>"><i class="fa fa-chevron-right"></i> <?php echo $item["Categorie"]["name"]; ?></a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

</div>