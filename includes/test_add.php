<html>
<head>
<meta charset "UTF=8">
<title></title>
</head>
<body>

<a href =" nurse-project.php">Home</a></br>

<form action ="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
			<div>DESCRIPTION <input type ="text" name ="desc" required/></div><br>
			<div>SUMMARY:<input type ="text" name ="sc" required/></div><br>
			<div>ADMIN_ID:<input type ="text" name ="aid" required/></div><br>
			<div>NURSE_ID:<input type ="text" name ="nid" required/></div><br>
			<div>START_DATE:<input type ="text" name ="start" required/></div><br>
			<div>END_DATE:<input type ="text" name ="end" required/></div><br>
			<div>
			</div><br>
			<div><input type ="submit" value= "SAVE" name="ss"/></div>
		</form>


		<?php
							if(isset($_REQUEST['desc'])){		
								$description=$_REQUEST['desc'];
								$summary=$_REQUEST['sc'];
								$admin_id=$_REQUEST['aid'];
								$nurse_id=$_REQUEST['nid'];
								$start_date=$_REQUEST['start'];
								$end_date=$_REQUEST['end'];
								include_once("model_task.php");
								$obj=new nurse();
								if($obj->addtask($decsription,$summary,$admin_id,$nurse_id,$start_date,$end_date)){
									echo "task added";
								}else{
									echo "Error adding task.";
								}
							}
								
						
						?>	
						</body>
						</html>		
							
						