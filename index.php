<html>
    	<head>
        	<meta charset="UTF-8">
    	</head>
    	<body>
        	<?php
				session_destroy();
        		session_start();
				$_SESSION['intentos']=4;
				$_SESSION['user']='root';
				header("Location: controllers/index.php");
        		#require_once('controllers/index.php');
        	?>
    	</body>
</html>