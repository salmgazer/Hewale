<?php
/**
*@author William Annoh
*/

include_once("adb.php");

class comments extends adb{
	/**
	*This method adds a comment
	*
	*@param int $t_id ID of the admin to be added
	*@param varchar $comment inputs the content of the comment 
	*/
	function addComment($t_id, $comment){

		$str_query = "INSERT INTO comments set task_id = '$t_id', set message = '$comment'";
		return $this->query($str_query);
	}
	/**
	*This method deletes a comment
	*
	*@param int $c_id ID of the comment to be added
	*/
	function delComment ($c_id){
		$str_query = "DELETE FROM comments where comment_id = '$c_id'";
		return $this->query($str_query);
	}
	/**
	*This method allows the user to view a comment
	*
	*@param int $c_id ID of the commment.
	*/
	function viewComment ($c_id){
		$str_query = "SELECT * FROM comments where comment_id = '$c_id'";
		return $this->query($str_query);
	}
}
?>