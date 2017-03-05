<div class="panel-group" id="mainmenu" role="tablist" aria-multiselectable="true">
                  
    
    <div class="panel panel-default">
        <div class="panel-heading paneltop" role="tab" id="heading1">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#mainmenu" href="#collapse1" aria-expanded="true" aria-controls="collapse1"><i class="fa fa-user"></i> <?php echo $this->Psd->text('Users'); ?></a>
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse <?php if ($this->params['controller']=="users" || $this->params['controller']=="specialpermissions" || $this->params['controller']=="customroles") echo "in"; ?>" role="tabpanel" aria-labelledby="heading1">
          <ul class="list-group">
            <li class="list-group-item">
                <i class="fa fa-reorder"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('List'),
					array('plugin' => 'phpstardust', 'controller' => 'users', 'action' => 'index')
				); 
				
				?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-plus"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('Add'),
					array('plugin' => 'phpstardust', 'controller' => 'users', 'action' => 'add')
				); 
				
				?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-address-book-o"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('Custom roles'),
					array('plugin' => 'phpstardust', 'controller' => 'customroles', 'action' => 'index')
				); 
				
				?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-user-circle"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('Permissions'),
					array('plugin' => 'phpstardust', 'controller' => 'specialpermissions', 'action' => 'index')
				); 
				
				?>
            </li>
          </ul>
        </div>
    </div>
    
    
    
    
    <div class="panel panel-default">
        <div class="panel-heading paneltop" role="tab" id="heading2">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#mainmenu" href="#collapse2" aria-expanded="true" aria-controls="collapse2"><i class="fa fa-pencil"></i> <?php echo $this->Psd->text('Articles'); ?></a>
          </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse <?php if (($this->params['controller']=="articles") && $this->params['action']!="dashboard") echo "in"; ?>" role="tabpanel" aria-labelledby="heading2">
          <ul class="list-group">
            <li class="list-group-item">
                <i class="fa fa-reorder"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('List'),
					array('plugin' => 'phpstardust', 'controller' => 'articles', 'action' => 'index')
				); 
				
				?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-plus"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('Add'),
					array('plugin' => 'phpstardust', 'controller' => 'articles', 'action' => 'add')
				); 
				
				?>
            </li>
          </ul>
        </div>
    </div>
    
    
    
    
    <div class="panel panel-default">
        <div class="panel-heading paneltop" role="tab" id="heading3">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#mainmenu" href="#collapse3" aria-expanded="true" aria-controls="collapse3"><i class="fa fa-tags"></i> <?php echo $this->Psd->text('Categories'); ?></a>
          </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse <?php if ($this->params['controller']=="categories") echo "in"; ?>" role="tabpanel" aria-labelledby="heading3">
          <ul class="list-group">
            <li class="list-group-item">
                <i class="fa fa-reorder"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('List'),
					array('plugin' => 'phpstardust', 'controller' => 'categories', 'action' => 'index')
				); 
				
				?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-plus"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('Add'),
					array('plugin' => 'phpstardust', 'controller' => 'categories', 'action' => 'add')
				); 
				
				?>
            </li>
          </ul>
        </div>
    </div>
    
    
    
    
    <div class="panel panel-default">
        <div class="panel-heading paneltop" role="tab" id="heading4">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#mainmenu" href="#collapse4" aria-expanded="true" aria-controls="collapse4"><i class="fa fa-file"></i> <?php echo $this->Psd->text('Pages'); ?></a>
          </h4>
        </div>
        <div id="collapse4" class="panel-collapse collapse <?php if ($this->params['controller']=="pages" && $this->params['action']!="dashboard") echo "in"; ?>" role="tabpanel" aria-labelledby="heading4">
          <ul class="list-group">
            <li class="list-group-item">
                <i class="fa fa-reorder"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('List'),
					array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'index')
				); 
				
				?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-plus"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('Add'),
					array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'add')
				); 
				
				?>
            </li>
          </ul>
        </div>
    </div>
    
    
    
    
    <div class="panel panel-default">
        <div class="panel-heading paneltop" role="tab" id="heading5">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#mainmenu" href="#collapse5" aria-expanded="true" aria-controls="collapse5"><i class="fa fa-wrench"></i> <?php echo $this->Psd->text('Settings'); ?></a>
          </h4>
        </div>
        <div id="collapse5" class="panel-collapse collapse <?php if ($this->params['controller']=="settings") echo "in"; ?>" role="tabpanel" aria-labelledby="heading5">
          <ul class="list-group">
            <li class="list-group-item">
                <i class="fa fa-toggle-on"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('Settings'),
					array('plugin' => 'phpstardust', 'controller' => 'settings', 'action' => 'edit', 1)
				); 
				
				?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-arrow-circle-down"></i>
                <?php 
			
				echo $this->Html->link(
					'Backup DB',
					array('plugin' => 'phpstardust', 'controller' => 'settings', 'action' => 'backupDb')
				); 
				
				?>
            </li>
            <li class="list-group-item">
                <i class="fa fa-arrow-circle-up"></i>
                <?php 
			
				echo $this->Html->link(
					$this->Psd->text('Import') .' DB',
					array('plugin' => 'phpstardust', 'controller' => 'settings', 'action' => 'importDb')
				); 
				
				?>
            </li>
          </ul>
        </div>
    </div>
    
  
</div>