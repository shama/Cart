<?php //debug($cart); ?>

<h2><?php echo __d('cart', 'Shopping Cart'); ?></h2>
<?php if (!empty($cart['CartsItem'])) : ?>
	<?php echo $this->Form->create('Cart'); ?>
		<table class="table table-striped table-bordered table-condensed">
			<thead>
				<tr>
					<th><?php echo __d('cart', 'Item'); ?></th>
					<th><?php echo __d('cart', 'Price'); ?></th>
					<th><?php echo __d('cart', 'Quantity'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($cart['CartsItem'] as $key => $item) : ?>
					<tr>
						<td><?php echo h($item['name']); ?></td>
						<td><?php echo CakeNumber::currency($item['total']); ?></td>
						<td>
							<?php
								echo $this->Html->link('remove', array('action' => 'remove_item', 'id' => $item['foreign_key'],'model' => $item['model']));
								if ($item['quantity_limit'] != 1) { 
									echo $this->Form->input('CartsItem.' . $key . '.quantity', array(
										'div' => false,
										'label' => false,
										'default' => $item['quantity'],
										'class' => 'input-small'));
								}
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
			<tfooter>
				<tr>
					<td><?php echo __d('cart', 'Total'); ?>
					<td colspan="2"><?php echo CakeNumber::currency($cart['Cart']['total']); ?></td>
				</tr>
			</tfooter>
		</table>
	<?php echo $this->Form->submit(__d('cart', 'Update cart')); ?>
	<?php echo $this->Form->end();?>

	<h3><?php echo __d('cart', 'Payment method'); ?></h3>
	<ul class="payment-methods">
		<?php $paymentMethods = Configure::read('Cart.PaymentMethod'); ?>
		<?php foreach ($paymentMethods as $paymentMethod) : ?>
		<li>
			<?php
				if (empty($paymentMethod['logo'])) {
					echo $this->Html->link($paymentMethod['name'], $paymentMethod['checkoutUrl']);
				} else {
					$image = $this->Html->image($paymentMethod['logo'], array('alt' => $paymentMethod['name']));
					echo $this->Html->link($image, $paymentMethod['checkoutUrl'], array('escape' => false));
				}
			?>
		</li>
		<?php endforeach;?>
	</ul>
<?php else : ?>
	<p><?php echo __d('cart', 'Your cart is empty.'); ?></p>
<?php endif; ?>