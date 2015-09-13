<?php
include_once("adb.php");

/**
 * Class task
 */
class task extends adb{

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
     */
    function suspend_task($id){
    }

    /**
     * @param $id
     * @return array|bool
     */
    function nurse_find_task($id){
        $str_sql = "SELECT * FROM task, admin WHERE task.task_id=$id AND admin.admin_id = task.admin_id limit 0,1";
        if (!$this->query($str_sql)) {
            return false;
        }
        return $this->fetch();
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

    /**
     * @param $admin_id
     * @return array|bool
     */
    function getAllAdminTasks($admin_id){
        $str_sql = "SELECT * FROM task, nurse where nurse.existence = 'yes' AND task.admin_id=$admin_id AND nurse.nurse_id = task.nurse_id  order by task.end_time";
        if (!$this->query($str_sql)) {
            return false;
        }
        return $this->fetch();
    }

    /**
     * @param $admin_id
     * @param $task_status
     * @return array|bool
     */
    function getAllAdminSpecTasks($admin_id, $task_status){
        $str_sql = "SELECT * FROM task, nurse where nurse.existence = 'yes' and task.admin_id=$admin_id and task.task_status like '$task_status' and nurse.nurse_id = task.nurse_id  order by task.end_time";
        if (!$this->query($str_sql)) {
            return false;
        }
        return $this->fetch();
    }

    /**
     * @param $nurse_id
     * @return array|bool
     */
    function getAllNurseTasks($nurse_id){
        $str_sql = "SELECT * FROM task where nurse_id=$nurse_id order by task.end_time";
        if (!$this->query($str_sql)) {
            return false;
        }
        return $this->fetch();
    }

    /**
     * @param $nurse_id
     * @param $task_status
     * @return array|bool
     */
    function getAllNurseSpecTasks($nurse_id, $task_status){
        $str_sql = "SELECT * FROM task WHERE nurse_id =$nurse_id AND task_status like '$task_status'";
        if (!$this->query($str_sql)) {
            return false;
        }
        return $this->fetch();
    }

    /**
     * @param $task_id
     * @return bool
     */
    function reject_completion($task_id){
        $str_sql = "UPDATE task set task_status='ongoing' where task_id=$task_id";
        return $this->query($str_sql);
    }

    /**
     * @param $task_id
     * @return bool
     */
    function accept_completion($task_id){
        $str_sql = "UPDATE task set task_status='finished' where task_id=$task_id";
        return $this->query($str_sql);
    }
}


?>