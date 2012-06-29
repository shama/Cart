<h2><?php echo __d('cart', 'Add new rule'); ?></h2>

<?php
	echo $this->Form->create();
	echo $this->Form->input('name', array(
		'label' => __d('cart', 'Name')));
	echo $this->Form->input('description', array(
		'label' => __d('cart', 'Description')));
	echo $this->Form->end(__d('cart', 'Submit'));
?>