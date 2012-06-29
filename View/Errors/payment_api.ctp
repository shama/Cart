<h2><?php echo __d('cart', 'There was an error with the Payment API'); ?></h2>
<p class="error">
	<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
</p>
<?php echo $this->element('exception_stack_trace'); ?>