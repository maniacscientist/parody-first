<?php
	global $superPage;
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Magebit</title>
		<link rel="stylesheet/less" href="site.less"/>
		<script type="text/javascript" src="libs/less.js"></script>
		<script type="text/javascript" src="libs/jquery-2.2.0.js"></script>
		<script type="text/javascript" src="libs/superlib/superlib.js"></script>
		<script type="text/javascript" src="site.js"></script>
	</head>
	<body onload="setupEvents()">

		<?= $superPage ?>

	</body>
</html>