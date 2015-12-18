<?php

/**
 * Created by PhpStorm.
 * User: apfnj
 * Date: 12/16/2015
 * Time: 12:10 AM
 */
class accountTest extends PHPUnit_Framework_TestCase
{
    /**
     * Function to test login
     */
    function testLogin() {
        $account = new account();
        $account->login("apfnjie@gmail.com", "testpass");
        $this->assertNull($account);
    }
}
