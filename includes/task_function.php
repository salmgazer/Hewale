
<?php
//include_once("adb.php");

/**
 * Class task
 */
//class task extends adb{

    /**
     * @param String $desc
     * @param String $summ
     * @param int $admin_id
     * @param $nurse_id
     * @param $start
     * @param $end
     * @return bool
     */
    
    function addtask($desc, $summ, $admin_id, $nurse_id, $start, $end){
        $str_sql = "INSERT INTO task (description,summary, admin_id, nurse_id, start_time, end_time)
 VALUES ('$desc', '$summ', '$admin_id', '$nurse_id', '$start', '$end')";
        return $this->query($str_sql);
    }

    /**
     * @param $id
     * @param $desc
     * @param $finish
     * @param $status
     * @return bool
     */
     function update_task($id, $desc, $finish, $status){
        $str_sql = "UPDATE task SET description='$desc', end_time='$finish', task_status='$status' where task_id=$id limit 0,1";
        return $this->query($str_sql);
    }

    /**
     * @param $id
     * @return array|bool
     */
    function admin_find_task($id){
        $str_sql = "SELECT * FROM task, nurse WHERE task.task_id=$id AND nurse.nurse_id = task.nurse_id limit 0,1";
        if (!$this->query($str_sql)) {
            return false;
        }
        return $this->fetch();
    }

?>