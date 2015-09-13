<?php session_start();

//class models included
include_once('../models/hospital.php');
include_once('../models/model_task.php');
include_once('../models/model_admin.php');

//create instances
$task = new task();
$hospital = new hospital();

/*Start of admin functions*/

//function for signing in an admin
function admin_login(){
	$admin = new admin();
	$signin = "False";
	if (isset($_POST['admin_username']) && isset($_POST['admin_password'])) {
		$username = $_POST['admin_username'];
		$password = $_POST['admin_password'];
		$the_admin = $admin->admin_login($username, $password);
		if (!$the_admin==null) {
			//Details Set
			//adminSession($the_admin['admin_username'], ($the_admin['password']));
			$signin = "True";
		}
	}
	return $signin;
}

//function to sign up admin
function admin_signup(){
	$sign_up = false;
	if (isset($_POST['admin_firstname']) && isset($_POST['admin_lastname']) && isset($_POST['admin_hospital_id'])) {
		$fn = $_POST['admin_firstname']; $ln = $_POST['admin_lastname']; $a_hid = $_POST['admin_hospital_id'];
		if(!$admin->add_admin($fn, $ln, $fn.'.'.$ln, 'newadmin', $a_hid) == null){
			$sign_up = true;
		}
	}
	return $sign_up;
}

//function to signout admin
function admin_logout(){
	session_destroy();
}

//funtion to delete admin
function remove_admin(){
	$admin_removed =  false;
	if (isset($_POST['admin_id'])) {
		$admin_id = $_POST['admin_id'];
		if($admin->delete_admin($admin_id) != null){
		$admin_removed = true;
	}
	}
	return $admin_removed;
}

//function to update admin
function update_admin(){
	$update_admin = false;
	if (isset($_POST['admin_id']) && isset($_POST['admin_username']) && isset($_POST['admin_lastname']) &&
	 isset($_POST['admin_firstname']) && isset($_POST['hospital_id'])) {
		$aid = $_POST['admin_id']; $nun = $_POST['admin_username']; $a_hid = $_POST['hospital_id'];
		if ($admin->update_admin($aid, $nun, $a_hid) != null) {
			$update_admin = true;
		}
	}
	return $update_admin;
}

//function to create session for admin
function adminSession($id, $name, $username, $password, $hospital_id){
	$_SESSION['admin_name'] = $name;
	$_SESSION['admin_username'] = $username;
	$_SESSION['admin_password'] = $password;
	$_SESSION['admin_id'] = $id;
	$_SESSION['admin_hospital_id'] = $hospital_id;
}

/*End of admin functions*/