<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
	</head>
	<body>
		<?php
			$URL = explode('/',$_SERVER['QUERY_STRING']);
			echo '<pre>';
			print_r($URL);
			echo '</pre>';
		?>
	</body>
</html>