
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

    /**
     * @param $id
     * @return array|bool
     */
    function admin_find_task($id)
    {
        $str_sql = "SELECT * FROM task, nurse WHERE task.task_id=$id AND nurse.nurse_id = task.nurse_id limit 0,1";
        if (!$this->query($str_sql)) {
            return false;
        }
        return $this->fetch();
    }

?>