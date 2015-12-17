<?php

/**
 *@author comfort tenjier
 */

include_once("adb.php");

class task extends adb
{

    /**
     * Class task
     */

    /**
     * @param $task_id
     * @param $desc
     * @param $start
     * @param $end
     * @return bool
     */
    function updatetask($task_id, $desc, $start, $end)
    {
        $str_sql = "UPDATE task SET description='$desc', start_time='$start', end_time='$end'
      where task_id=$task_id limit 0,1";
        return $this->query($str_sql);
    }

}
?>