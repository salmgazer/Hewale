<?php

include_once("adb.php");

class account extends adb {
    
    /**
     * Function to login in a user
     */
    function login($email, $password) {
        $str_query = "SELECT * FROM accounts WHERE email = '$email' AND password = '$password' LIMIT 1";
        $this->query($str_query);
        return $this->fetch();
    }
}
?>