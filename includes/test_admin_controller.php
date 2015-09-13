	<?php
			include ("admin_controller.php");
			echo admin_login();
									
							
							?>	
<html>
<head>
<meta charset "UTF=8">
<title></title>
</head>
<body>

	<form action ="<?php $_SERVER['PHP_SELF']; ?>" method = "POST">
				<div>USERNAME:<input type ="text" name ="admin_username" required/></div><br>
				<div>PASSWORD:<input type ="text" name ="admin_password" required/></div><br>
				<div>
				</div><br>
				<div><input type ="submit" value= "SAVE" name="ss"/></div>
			</form>
		
							</body>
							</html>		
								
							