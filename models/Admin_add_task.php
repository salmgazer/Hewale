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
     * @param String $desc
     * @param int $task_id
     * @param $admin_id
     * @param $start
     * @param $end
     * @return bool
     */
    function addtask( $task_id, $admin_id, $desc, $start, $end)
    {
        $str_sql = "INSERT INTO task ( task_id, admin_id, description, start_time, end_time)
 VALUES ( '$task_id', '$admin_id','$desc', '$start', '$end')";
        return $this->query($str_sql);
    }


}
?>