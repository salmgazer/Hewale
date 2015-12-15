<?php

/**
 *@author comfort tenjier
 */

include_once("adb.php");

class tasks extends adb
{

    /**
     * Class tasks
     */

    /**
     * @param int $task_id
     * @return bool
     */
    function removetask($task_id) {
        $str_sql = "UPDATE task set existence = 'no' where task_id =$task_id";
        return $this->query($str_sql);
    }

}
?>