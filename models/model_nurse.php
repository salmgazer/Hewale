<?php
include_once("adb.php");

/**
 * Class nurse
 */
class nurse extends adb {

    /**
     * @param String $name
     * @param String $user
     * @param String $status
     * @param String $password
     * @param int $hospital_id
     * @return bool
     */
	 function add_nurse($name, $user, $status, $password, $hospital_id) {
		$str_sql = "INSERT into nurse (fullname,username,status, password,hospital_id)
		VALUES ('$name','$user', '$status','$password',$hospital_id)";
		return $this->query($str_sql); 
	 }

    /**
     * @param int $nurse_id
     * @param String $user
     * @param int $hospital_id
     * @return bool
     */
	 function update_nurse($nurse_id, $user,$hospital_id) {
		$str_sql = "UPDATE nurse SET username='$user', hospital_id=$hospital_id WHERE nurse_id = $nurse_id limit 0,1";
		
		return $this->query($str_sql); 
	 }

    /**
     * @param int $nurse_id
     * @return bool
     */
	function removeNurse($nurse_id) {
		$str_sql = "UPDATE nurse set existence = 'no' where nurse_id =$nurse_id";
		return $this->query($str_sql); 
	 }

    /**
     * @param int $nurse_id
     * @return array|bool
     */
	 function get_nurse($nurse_id) {
		$str_sql = "SELECT * from nurse where nurse_id=$nurse_id limit 0,1";
		if(!$this->query($str_sql)){
			return false;
		}	
		return $this->fetch(); 
	 }

    /**
     * @param String $nurse_username
     * @param String $nurse_password
     * @return array|bool
     */
	 function login($nurse_username, $nurse_password){
	 	$str_sql = "SELECT * FROM nurse WHERE existence = 'yes' AND username = '$nurse_username' AND password = '$nurse_password' limit 0,1";
	 	if (!$this->query($str_sql)) {
	 		return false;
	 	}
	 	return $this->fetch();
	 }

    /**
     * @param int $hospital_id
     * @param String $nurse_status
     * @return array|bool
     */
    function getAllNurses($hospital_id, $nurse_status) {
            $str_sql = "SELECT * from nurse where existence = 'yes' AND hospital_id = $hospital_id";
            if($nurse_status != 'all'){
            $str_sql = "SELECT * from nurse where existence = 'yes' AND hospital_id = $hospital_id and status like '$nurse_status'";
        }
		if(!$this->query($str_sql)) {
            return false;
        }
        return $this->fetch();
	 }

}


 
?>
