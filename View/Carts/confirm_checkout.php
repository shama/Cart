<h2><?php __('Review Your Order')?></h2>
<p>
<?php 
	__('Please review your order and and click below to complete your payment.');
?>

<?php debug($cart); ?>

<h3><?php __('You must click on the "Complete my purchase" button below to complete your purchase'); ?></h3>
<?php 
	echo $this->Form->create('Checkout', array('url' => $this->here));
	echo $this->Form->hidden('confirm_checkout', array('value' => 1));
	echo $this->Form->submit(__('Complete my purchase', true), array('class' => 'button dark'));
	echo $this->Form->end();
?>
