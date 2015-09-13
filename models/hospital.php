<?php

include_once("adb.php");

/**
 * Class hospital
 */
class hospital extends adb {
    /*Constructor of class*/
	function hospital(){
	}

    /**
     * @param String $name
     * @param String $location
     * @param int $number
     * @return bool
     */
	 function add_hospital($name,$location,$number){
		$str_query = "INSERT into hospital set hospital_name='$name', location = '$location', phone = '$number'";
		return $this->query($str_query);
		}

    /**
     * @param int $hospital_id
     * @return bool
     */
	function delete_hospital($hospital_id){
		$str_query = "delete from hospital where hospital_id=$hospital_id limit 0,1";
		return $this->query($str_query);

	}

    /**
     * @param String $name
     * @param String $location
     * @return array
     */
    function getHospitalId($name, $location){
        $str_query = "select hospital_id from hospital where hospital_name = '$name' and location = '$location' limit 0,1";
        $this->query($str_query);
        return $this->fetch();
    }

    /**
     * @param String $name
     * @return bool
     */
	function search_hospital($name){
		$nurse_search = "select * from hospital where hospital_name LIKE '%$name%'";
        return $this->query($nurse_search);
    }

    /**
     * @param String $name
     * @param int $id
     * @return bool
     */
    function edit_hospital($name,$id){
        $str_query="update hospital set hospital_name='$name' where hospital_id=$id";
		return $this->query($str_query);
    }

    /**
     * @return array|bool
     */
    function getAllHospitals(){
        $str_query = "select * from hospital";
        if(!$this->query($str_query)){
            return false;
        }
        return $this->fetch();
    }


	}

	
?>