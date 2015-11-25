<?php
/**
*@author Adjoa Kwakye
*this page allows an administrator to add a nurse to a database
**/

	if(!isset($_REQUEST['cmd'])){
		echo '{"result":0, message:"unknown command"}';
		exit();
	}

	$cmd=$_REQUEST['cmd'];
	switch ($cmd) {
		case 1:
			if(isset($_REQUEST["name"])){
			 	
				include_once ("addnurse.php");
				$name = $_REQUEST["name"];
				$account = $_REQUEST["account"];
				$email = $_REQUEST["email"];
				$password = $_REQUEST["password"];

				$obj = new nurse();
				if($obj->add_nurse($name,$account,$email,$password)){					
					echo '{"result":1}';        
				}
				else{
					echo '{"result":0}'; 
				}
			}
			else{
					echo '{"result":0}'; 
			}		

		break;

		case 2;
		if(isset($_REQUEST['id'])){
		include_once ("addnurse.php");
		$obj=new nurse();
		$id=$_REQUEST['id'];
		
		if($obj->delete_nurse($id)){
			echo '{"result":1}';
			
									  }
		else{
			echo '{"result":0}';
		    }

						   } 
	
		break;
		default:
		echo '{"result":0,"message":"unknown command"}';
}


?>

