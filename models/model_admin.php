<?php 
include_once("adb.php");

/**
 * Class admin
 */
class admin extends adb{

	/**
	 * @param String $fn
	 * @param String $ln
	 * @param String $user
	 * @param String $password
	 * @param int $hospital_id
	 * @return bool
	 */
	function add_admin($fn, $ln, $user, $password, $hospital_id){
		$str_query = "INSERT INTO admin (firstname, lastname, username, password, hospital_id) VALUES ('$fn', '$ln', '$user', '$password', $hospital_id)";
		return $this->query($str_query);
	}

	/**
	 * @param int $id
	 * @param String $fn
	 * @param String $ln
	 * @param String $user
	 * @param String $password
	 * @param int $hospital_id
	 * @return bool
	 */
	function update_admin($id, $fn, $ln, $user, $password, $hospital_id){
		
		$str_query = "UPDATE admin SET firstname = '$fn', lastname = '$ln', username = '$user', password = '$password', hospital_id = $hospital_id where
		 admin_id = $id";
		return $this->query($str_query);
	}

    /**
     * @param int $id
     * @return bool
     */
	function delete_admin($id){
		$str_query = "DELETE FROM admin where admin_id = '$id'";
		return $this->query($str_query);

	}

    /**
     * @param String $username
     * @param String $password
     * @return array|bool
     */
    function login($username, $password){
        $str_query = "SELECT * FROM admin where username = '$username' AND password = '$password' limit 0,1";
        if(!$this->query($str_query)){
            return false;
        }
        return $this->fetch();
    }
}


 ?>