<?php

if (Configure::read('Psd.paginationType')=="numbers") {

	if ($this->Paginator->numbers()!=NULL) {
		
		$num = explode(' ',$this->Paginator->counter());
		
		echo '<p>' .$this->Psd->text('Page') .' ' .$num[0] .' ' .$this->Psd->text($num[1]) .' ' .$num[2] .'</p>';
		
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
<nav aria-label="...">
  <ul class="pager">
    <li class="previous"><?php echo $this->Paginator->prev($this->Psd->text('Previous')); ?></li>
    <li class="next"><?php echo $this->Paginator->next($this->Psd->text('Next')); ?></li>
  </ul>
</nav>
<?php
	
}

?>