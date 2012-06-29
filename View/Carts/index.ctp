<h2><?php __d('cart', 'Your saved carts'); ?></h2>
<?php if (!empty($carts)) : ?>
	<table>
		<tbody>
		<?php foreach ($carts as $cart) : ?>
			<tr>
				<td><?php echo $this->Html->link($cart['Cart']['name'], array('controller' => 'carts', 'action' => 'view', $cart['Cart']['view'])); ?></td>
				<td><?php echo $cart['Cart']['item_count']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else : ?>
	<p><?php __d('cart', 'You do not have a filled cart'); ?></p>
<?php endif; ?>
