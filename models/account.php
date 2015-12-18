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

}
?>
