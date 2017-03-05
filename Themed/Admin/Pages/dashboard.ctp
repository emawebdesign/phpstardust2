<div class="panel panel-default">
  <div class="panel-body">
  
  	<?php echo $this->Session->flash(); ?>
  
  	<h1><?php echo $this->Psd->text('Welcome in your dashboard'); ?></h1>
    
    <div class="panel panel-default portlet">
      <div class="panel-body">
        <?php echo date("Y-m-d H:i:s"); ?>
      </div>
    </div>
    
    <div class="row">
    
    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        
        	<div class="panel panel-default panel-paneltop">
              <div class="panel-body text-center">
                <p><?php echo $users; ?></p>
              </div>
              <div class="panel-footer"><?php echo $this->Psd->text('Users'); ?></div>
            </div>
        
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        
        	<div class="panel panel-default panel-paneltop">
              <div class="panel-body text-center">
                <p><?php echo $administrators; ?></p>
              </div>
              <div class="panel-footer"><?php echo $this->Psd->text('Administrators'); ?></div>
            </div>
        
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        
        	<div class="panel panel-default panel-paneltop">
              <div class="panel-body text-center">
                <p><?php echo $editors; ?></p>
              </div>
              <div class="panel-footer"><?php echo $this->Psd->text('Editors'); ?></div>
            </div>
        
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        
        	<div class="panel panel-default panel-paneltop">
              <div class="panel-body text-center">
                <p><?php echo $authors; ?></p>
              </div>
              <div class="panel-footer"><?php echo $this->Psd->text('Authors'); ?></div>
            </div>
        
        </div>
    
    </div>
    
    <div class="row">
    
    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        
        	<div class="panel panel-default panel-paneltop">
              <div class="panel-body text-center">
                <p><?php echo $customroles; ?></p>
              </div>
              <div class="panel-footer"><?php echo $this->Psd->text('Custom roles'); ?></div>
            </div>
        
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        
        	<div class="panel panel-default panel-paneltop">
              <div class="panel-body text-center">
                <p><?php echo $pages; ?></p>
              </div>
              <div class="panel-footer"><?php echo $this->Psd->text('Pages'); ?></div>
            </div>
        
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        
        	<div class="panel panel-default panel-paneltop">
              <div class="panel-body text-center">
                <p><?php echo $articles; ?></p>
              </div>
              <div class="panel-footer"><?php echo $this->Psd->text('Articles'); ?></div>
            </div>
        
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        
        	<div class="panel panel-default panel-paneltop">
              <div class="panel-body text-center">
                <p><?php echo $categories; ?></p>
              </div>
              <div class="panel-footer"><?php echo $this->Psd->text('Categories'); ?></div>
            </div>
        
        </div>
    
    </div>
  
  </div>
</div>