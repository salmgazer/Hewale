<?php

include_once("adb.php");

/**
 * Class account to handle all functions relating to accounts
 */
class account extends adb {

    /**
     * @param $email
     * @param $password
     * @return array
     */
    function login($email, $password) {
        $str_query = "SELECT * FROM h_accounts WHERE email = '$email' AND password = '$password' LIMIT 1";
        $this->query($str_query);
        return $this->fetch();
    }

    /**
     *Function to get all nurse info
     */
    function get_all_nurses() {
      $str_query = "SELECT * from h_accounts WHERE type = 'nurse'";
      $this->query($str_query);
      return $this->fetch();
    }

}
?>
