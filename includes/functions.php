<?php session_start();

//include class models
include_once('./models/hospital.php');
include_once('./models/model_task.php');
include_once('./models/model_nurse.php');
include_once('./models/model_admin.php');

//create instances
//$nurse = new nurse();
$task = new task();
$hospital = new hospital();

/*Start of nurse functions*/

//function to sign in a nurse
function nurse_login(){
	$nurse = new nurse();
	$signin = "Not true";
	if (isset($_POST['nurse_username']) && isset($_POST['nurse_password'])) {
		$password = $_POST['nurse_password'];
		$username = $_POST['nurse_username'];

		$the_nurse = $nurse->login($username, $password);
		if (!$the_nurse==false) {
			//set details here
			nurseSession($the_nurse['nurse_id'], ($the_nurse['firstname'].' '.$the_nurse['lastname']), $the_nurse['username'],
			 $the_nurse['password'], $the_nurse['status'], $the_nurse['hospital_id']);
			$signin = "True";
		}
	}
	return $signin;
}

//function to sign up nurse
function nurse_signup(){
	$signup = false;
	if (isset($_POST['nurse_firstname']) && isset($_POST['nurse_lastname']) && isset($_POST['nurse_status']) && isset($_POST['nurse_hospital_id'])) {
		$fn = $_POST['nurse_firstname']; $ln = $_POST['nurse_lastname']; $st = $_POST['nurse_status']; $hid = $_POST['nurse_hospital_id'];
		if(!$nurse->add_nurse($fn, $ln, $fn.'.'.$ln, 'newnurse', $hid) == null){
			//tell that nurse has been added
			$signup = true;
		}
	}
	return $signup;
}

//function to signout nurse
function nurse_logout(){
	session_destroy();
}

//funtion to delete nurse
function remove_nurse(){
	$nurse_removed =  false;
	if (isset($_POST['nurse_id'])) {
		$nurse_id = $_POST['nurse_id'];
		if($nurse->delete_nurse($nurse_id) != null){
		$nurse_removed = true;
	}
	}
	return $nurse_removed;
}

//function to update nurse
function update_nurse(){
	$update_nurse = false;
	if (isset($_POST['nurse_id']) && isset($_POST['nurse_username']) && isset($_POST['hospital_id'])) {
		$nid = $_POST['nurse_id']; $nun = $_POST['nurse_username']; $hid = $_POST['hospital_id'];
		if ($nurse->update_nurse($nid, $nun, $hid) != null) {
			$update_nurse = true;
		}
	}
	return $update_nurse;
}

//function to create session for nurse
function nurseSession($id, $name, $username, $password, $status, $hospital_id){
	$_SESSION['nurse_name'] = $name;
	$_SESSION['nurse_username'] = $username;
	$_SESSION['nurse_password'] = $password;
	$_SESSION['nurse_id'] = $id;
	$_SESSION['nurse_status'] = $status;
	$_SESSION['nurse_hospital_id'] = $hospital_id;
}

/*End of nurse functions*/

//test function to login
