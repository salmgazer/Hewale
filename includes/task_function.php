
<?php
include_once('../models/model_task.php');
include_once('../models/adb.php');

/**
 * Class task
 */



    /**
     * @param String $desc
     * @param int $task_id
     * @param $nurse_id
     * @param $start
     * @param $end
     * @return bool
     */

    function addtask( $task_id, $nurse_id, $desc, $start, $end)
    {
        $str_sql = "INSERT INTO task ( task_id, nurse_id, description, start_time, end_time)
 VALUES ( '$task_id', '$nurse_id','$desc', '$start', '$end')";
        return $this->query($str_sql);
    }

/**
 * @param int $task_id
 * @return bool
 */
   function removetask($task_id) {
    $str_sql = "UPDATE task set existence = 'no' where task_id =$task_id";
    return $this->query($str_sql);
   }

    /**
     * @param $id
     * @param $desc
     * @param $finish
     * @param $status
     * @return bool
     */
    function update_task($id, $desc, $finish, $status)
    {
        $str_sql = "UPDATE task SET description='$desc', end_time='$finish', task_status='$status' where task_id=$id limit 0,1";
        return $this->query($str_sql);
    }



?>