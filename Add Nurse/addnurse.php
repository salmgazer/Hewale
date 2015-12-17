<?php
	/**
*@author Adjoa Kwakye
*@version 1.0.2
*this page contains all functions for a nurse
**/
include_once("adb.php");
    class nurse extends adb
    {
        function nurse()
        {
        }

        /**
	*@method boolean add_nurse() This Adds a Nurse
	*@param String name name of nurse
	*@param String account whether the user is an administrator or nurse
	*@param String email the email of the nurse
	*@param String password the password which will be given to a nurse
	*@return return bool
	**/
        function add_nurse($name,$account,$email,$password)
        {
            $str_query = "INSERT into h_account set h_fullname='$name',
		                                      h_account_type='$account',
		                                      h_email='$email',
		                                      h_password='$password' ";
            return $this->query($str_query);
        }


        /**
	*@method boolean delete_nurse() Deletes a Nurse
	*@param Int id the id of a nurse
	*@return return bool
	**/
        function delete_nurse($id)
        {
            $str_query = "DELETE from h_account where h_account_id ='$id'";
            return $this->query($str_query);
        }
        

        /**
	*@method boolean search_nurse() Searches a Nurse
	*@param String name the name of a nurse
	*@return return bool
	**/
        function search_nurse($name)
        {
            $str_query = "SELECT * from h_account where h_fullname LIKE '%$name'";
            return $this->query($str_query);
        }

    }