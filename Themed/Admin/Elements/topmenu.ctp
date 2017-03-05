<div class="container-fluid topmenu text-center visible-lg visible-md visible-sm">
    
    <div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
            <ul class="list-unstyled list-inline">
                <li><a href="<?php echo Configure::read('Psd.url'); ?>/dashboard"><i class="fa fa-home fa-2x"></i> <p>Dashboard</p></a></li>
                <li><a href="<?php echo Configure::read('Psd.url'); ?>/phpstardust/users"><i class="fa fa-user fa-2x"></i> <p><?php echo $this->Psd->text('Users'); ?></p></a></li>
                <li><a href="<?php echo Configure::read('Psd.url'); ?>/phpstardust/categories"><i class="fa fa-tags fa-2x"></i> <p><?php echo $this->Psd->text('Categories'); ?></p></a></li>
                <li><a href="<?php echo Configure::read('Psd.url'); ?>/phpstardust/articles"><i class="fa fa-list fa-2x"></i> <p><?php echo $this->Psd->text('Articles'); ?></p></a></li>
                <li><a href="<?php echo Configure::read('Psd.url'); ?>/phpstardust/pages"><i class="fa fa-file fa-2x"></i> <p><?php echo $this->Psd->text('Pages'); ?></p></a></li>
                <li><a href="<?php echo Configure::read('Psd.url'); ?>/phpstardust/settings/edit/1"><i class="fa fa-wrench fa-2x"></i> <p><?php echo $this->Psd->text('Settings'); ?></p></a></li>
            </ul>
        
        </div>
    
    </div>

</div>