<?php
include_once("adb.php");

/**
 * Class task
 */
class task extends adb {

  /**
   * Function to get all task
   */
  function getAllTask() {
    $str = "SELECT * FROM h_task";
    $this->query($str);
    return $this->fetch();
  }
}
