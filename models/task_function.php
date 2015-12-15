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
/**
 * @param int $task_id
 * @return bool
 */
function removetask($task_id)
{
    $str_sql = "UPDATE task set existence = 'no' where task_id =$task_id";
    return $this->query($str_sql);
}
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