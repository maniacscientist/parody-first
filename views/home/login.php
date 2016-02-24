<?php
/* @var userModel $superModel */
global $superModel;
global $superCode;
?>
<center>
	<?php if($superCode==1) { ?>

		<h1 class="proposalHeader">Login or password is incorrect!</h1><br/>
		<input type="button" class="messageButton" value="Try again" onclick="closeMessage();" />

	<?php } ?>
</center>