<?php

if (Configure::read('Psd.paginationType')=="numbers") {

	if ($this->Paginator->numbers()!=NULL) {
		
		$num = explode(' ',$this->Paginator->counter());
		
		echo '<p class="numberOfPages">' .$this->Psd->text('Page') .' ' .$num[0] .' ' .$this->Psd->text($num[1]) .' ' .$num[2] .'</p>';
		
		echo '<ul class="pagination">';
		echo '<li>' .$this->Paginator->first($this->Psd->text('First')) .'</li>';
		echo '<li>' .$this->Paginator->prev($this->Psd->text('Previous')) .'</li>';
		echo '<li>' .$this->Paginator->numbers(array('separator'=>' ')) .'</li>';
		echo '<li>' .$this->Paginator->next($this->Psd->text('Next')) .'</li>';
		echo '<li>' .$this->Paginator->last($this->Psd->text('Last')) .'</li>';
		echo '</ul>';
		
	}

} else {

?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">
    	<?php echo $this->Paginator->prev($this->Psd->text('Previous')); ?>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
    	<?php echo $this->Paginator->next($this->Psd->text('Next')); ?>
    </div>
</div>
<?php
	
}

?>