<?php
	/* @var userModel[] $superModel */
	global $superModel;
?>

<table align="center" border="1">
	<tr>
		<th colspan="3">
			Users here... Seems, DB is up
		</th>
	</tr>
	<tr>
		<th>Name</th>
		<th>E-mail</th>
		<th>Password (no MD5 this time)</th>
	</tr>
	<?php foreach($superModel as $user) { ?>

		<tr>
			<td><?= $user->name ?></td>
			<td><?= $user->email ?></td>
			<td><?= $user->password ?></td>
		</tr>

	<?php } ?>
</table>