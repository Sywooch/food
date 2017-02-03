<?php
?>

<?php if ($products): ?>
	<?php foreach ($products as $key => $p): ?>
		<option value="<?= $p->header ?>"></option>
	<?php endforeach ?>
<?php endif ?>