<?php

include "adb.php";

class nurse extends adb{

    /**
     * @param $email
     * @param $password
     * @return array|bool
     */
    function mobileLogin($email, $password){
        $str_sql = "select * from h_account WHERE h_email = '$email' AND h_password = '$password'";
        $this->query($str_sql);
        $details = $this->fetch();
        if($details == null){
            return false;
        }
        return $details;
    }

    /**
     * @param $nurse_id
     * @return array|bool
     */
  function viewTasks($nurse_id){
      $str_sql = "select * from h_task where nurse_id = '$nurse_id'";
      $this->query($str_sql);
      $tasks = $this->fetch();
      if($tasks == null){
          return false;
      }
      return $tasks;
  }

    /**
     * @param $task_id
     * @return array|bool
     */
  function getTaskDetailsById($task_id){
      $str_sql = "select * from h_task where h_task_id = '$task_id'";
      $this->query($str_sql);
      $task = $this->fetch();
      if($task == null){
          return false;
      }
      return $task;
  }

    /**
     * @param $task_id
     * @return array|bool|null
     */
  function getTaskComments($task_id){
      $str_sql = "select * from h_task where h_task_id = '$task_id'";
      $this->query($str_sql);
      $comments = $this->fetch();
      if($comments = null){
          return false;
      }
      return $comments;
  }

    /**
     * @param $task_id
     * @param $message
     * @return bool
     */
  function addComment($task_id, $message){
      $str_sql = "insert into h_comments (message, sent_by, h_task_id) VALUES ('$message', 'nurse', $task_id)";
      return $this->query($str_sql);
  }

    function requestCompletion($task_id){
        $str_sql = "update h_task set request_completion = 'yes' where h_task_id = '$task_id' limit 0,1";
        return$this->query($str_sql);
    }

}
 ?>
