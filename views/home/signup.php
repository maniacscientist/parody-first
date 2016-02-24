<?php
/* @var userModel $superModel */
global $superModel;
global $superCode;
?>
<center>
	<?php if($superCode==0) { ?>

		<h1 class="proposalHeader">You have successfully registred! Welcome, <?= $superModel->name ?>! Use your new credentials to login</h1><br/>
		<input type="button" class="messageButton" value="Login" onclick="closeMessage(); switchToLogin();" />

	<?php } elseif($superCode==1) { ?>

		<h1 class="proposalHeader">E-mail <?= $superModel->email ?> is invalid! Try again! </h1><br/>
		<input type="button" class="messageButton" value="Try again" onclick="closeMessage();"/>

	<?php } ?>
</center>