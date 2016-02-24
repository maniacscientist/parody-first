<?php

global $superCode;
/* @var userModel $superModel */
global $superModel;
?>

<div class="greatbigwhiteworld">
	<div style="width: 900px; margin: auto">


		<?php if($superCode==0) { ?>
			<table align="center">
				<tr>
					<th>Attribute</th>
					<th>Value</th>
				</tr>
				<form id="userAttributes">
				<?php
				/* @var keyValuePair $attribute */
				foreach($superModel->attributes as $attribute) { ?>

					<tr>
						<td>
							<?= $attribute->name ?>
						</td>
						<td>
							<input name="<?= $attribute->name ?>" class="uberField" value="<?= $attribute->value ?>" />
						</td>
					</tr>

			<?php } ?>
				</form>
				<tr><td colspan="2"><input type="button" value="Save" onclick="saveAttributes()" /></td></tr>
			</table>
		<?php } elseif($superCode==1) { ?>

		Something wrong here. Please, <input type="button" class="messageButton" value="login" onclick="loginAgain()" /> again

		<?php } ?>

	</div>
</div>
