<h2><?php echo __('Cart Rules for Taxes and Discounts'); ?></h2>
<?php if (!empty($cartRules)) : ?>
	<table>
		<?php foreach ($cartRules as $rule) : ?>
			<tr>
				<td><?php echo $this->Html->link($rule['CartRule']['name'], array('action' => 'edit', $rule['CartRule']['id'])); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	<p><?php echo __('No rules set up.'); ?></p>
<?php endif; ?>